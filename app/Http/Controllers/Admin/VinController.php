<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use App\Models\Vin;

class VinController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Vin::class);

        $vins = Vin::all();

        $trashedVins = Vin::onlyTrashed()->get();

        return view('admin.vins.index', compact('vins', 'trashedVins'));
    }

    public function create()
    {
        $this->authorize('create', Vin::class);

        return view('admin.vins.create');
    }

    public function store(Request $request)
    {

        $this->authorize('create', Vin::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'annee' => 'nullable',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.numeric' => 'Le champ "Prix" doit être un nombre.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
            'prix.min' => 'Le champ "Prix" doit être supérieur ou égal à 0.',
        ]);

        // Créer le plat en utilisant les données validées
        $vin = new Vin();
        $vin->nom = $validatedData['nom'];
        $vin->description = $validatedData['description'];
        $vin->prix = $validatedData['prix'];
        $vin->annee = $validatedData['annee'];
        $vin->status = $validatedData['status'];
       

        // Enregistrement de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Générer un nom unique pour la photo
            $photoName = uniqid('vin_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/vins/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/vins/thumbnails/' . $photoName));

            // Enregistrer les noms des fichiers dans la base de données
            $vin->photo_portrait = $photoName;
            $vin->photo_thumbnail = $photoName;
        }
  
        $vin->save();

        return redirect()->route('admin.vins.index')->with('success', 'Le vin a été créé avec succès.');
    }

    public function edit(string $id)
    {
        $this->authorize('update', Vin::class);

        $vin = Vin::findOrFail($id);
        $statusChecked = old('status', $vin->status) ? 'checked' : '';
        return view('admin.vins.edit', compact('vin', 'statusChecked'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('update', Vin::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'annee' => 'nullable',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.numeric' => 'Le champ "Prix" doit être un nombre.',
            'prix.min' => 'Le champ "Prix" doit être supérieur ou égal à 0.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
        ]);
    
        $vin = Vin::findOrFail($id);
        $vin->nom = $request->nom;
        $vin->description = $request->description;
        $vin->prix = $request->prix;
        $vin->annee = $request->annee;
        $vin->status = $request->status;

            // Gérer l'image
        if ($request->hasFile('photo')) {
            // Supprimer les anciens fichiers d'image s'ils existent
            if($vin->photo_portrait && $vin->photo_thumbnail) {
                $portraitPath = public_path('storage/vins/portraits/' . $vin->photo_portrait);
                $thumbnailPath = public_path('storage/vins/thumbnails/' . $vin->photo_thumbnail);
    
                if (file_exists($portraitPath)) {
                    unlink($portraitPath);
                }
    
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = uniqid('vin_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/vins/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/vins/thumbnails/' . $photoName));

            // Mettre à jour les noms des fichiers dans la base de données
            $vin->photo_portrait = $photoName;
            $vin->photo_thumbnail = $photoName;
        } elseif ($request->has('supprimer_photo')) {
            // Supprimer les fichiers d'image existants
            $portraitPath = public_path('storage/vins/portraits/' . $vin->photo_portrait);
            $thumbnailPath = public_path('storage/vins/thumbnails/' . $vin->photo_thumbnail);

            if (file_exists($portraitPath)) {
                unlink($portraitPath);
            }

            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            // Effacer les noms des fichiers dans la base de données
            $vin->photo_portrait = null;
            $vin->photo_thumbnail = null;
        }

        $vin->save();
    
        return redirect()->route('admin.vins.index')->with('success', 'Le vin a été modifié avec succès.');
    }

    public function trash()
    {
        $this->authorize('viewInTrash', Vin::class);

        $trashedVins = Vin::onlyTrashed()->get();

        return view('admin.vins.trash', compact('trashedVins'));
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('softDelete', Vin::class);

        $vinIds = json_decode($request->input('selectedVins', '[]'), true);
       
        if (!is_array($vinIds)) {
            $vinIds = [$vinIds];
        }

        $count = count($vinIds);
        // dd($count);
        if ($count > 0) {
            Vin::whereIn('id', $vinIds)->delete();
        
            return redirect()->route('admin.vins.index')
                ->with('success', 'Vin(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.vins.index')
            ->with('error', 'Aucun vin sélectionné.');
    }

    public function forceDestroyMultiple(Request $request)
    {
  
        $this->authorize('forceDelete', Vin::class);

        $vinIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($vinIds)) {
            $vinIds = [$vinIds];
        }
        $vinIds = array_map('intval', $vinIds);
        $count = count($vinIds);

        if ($count > 0) {
            $vinsWithTrashed = Vin::withTrashed()->whereIn('id', $vinIds)->get();
            foreach ($vinsWithTrashed as $vin) {

                $portraitPath = public_path('storage/vins/portraits/' . $vin->photo_portrait);
                $thumbnailPath = public_path('storage/vins/thumbnails/' . $vin->photo_thumbnail);
    
                if ($portraitPath && File::exists($portraitPath)) {
                    File::delete($portraitPath);
                }
                
                if ($thumbnailPath && File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }


            }
            Vin::whereIn('id', $vinIds)->forceDelete();
        
            return redirect()->route('admin.vins.index')
                ->with('success', 'Vin(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.vins.index')
            ->with('error', 'Aucun vin sélectionné.');
    }

    public function restoreMultiple(Request $request)
    {
        $this->authorize('restore', Vin::class);

        $vinIds = json_decode($request->input('selectedItems'));

        if (!is_array($vinIds)) {
            $vinIds = [$vinIds];
        }

        $count = count($vinIds);

        if ($count > 0) {
            Vin::whereIn('id', $vinIds)->restore();
        
            return redirect()->route('admin.vins.index')
                ->with('success', 'Vin(s) restauré(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucun vin sélectionné.');
    }
}
