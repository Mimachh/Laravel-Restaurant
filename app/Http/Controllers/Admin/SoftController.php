<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use App\Models\Soft;
use App\Models\Allergene;

class SoftController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Soft::class);

        $softs = Soft::with('allergenes')->get();

        $trashedSofts = Soft::onlyTrashed()->get();

        return view('admin.softs.index', compact('softs', 'trashedSofts'));
    }

    public function create()
    {
        $this->authorize('create', Soft::class);
        $allergenes = Soft::all();

        return view('admin.softs.create', compact('allergenes'));
    }

    public function store(Request $request)
    {

        $this->authorize('create', Soft::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'prix' => 'nullable|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.required' => 'Le champ "Prix" est requis.',
            'prix.numeric' => 'Le champ "Prix" doit être un nombre.',
            'prix.min' => 'Le champ "Prix" doit être supérieur ou égal à 0.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
            'allergenes.array' => 'Les allergènes doivent être de type tableau.'
        ]);

        // Créer le plat en utilisant les données validées
        $soft = new Soft();
        $soft->nom = $validatedData['nom'];
        $soft->prix = $validatedData['prix'];
        $soft->info_supp = $validatedData['info_supp'];
        $soft->status = $validatedData['status'];
       

        // Enregistrement de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Générer un nom unique pour la photo
            $photoName = uniqid('soft_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/softs/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/softs/thumbnails/' . $photoName));

            // Enregistrer les noms des fichiers dans la base de données
            $soft->photo_portrait = $photoName;
            $soft->photo_thumbnail = $photoName;
        }
  
        $soft->save();

        $allergenes = $request->input('allergenes');
        if(!empty($allergenes)) {
            $soft->allergenes()->attach($allergenes);
        }

        return redirect()->route('admin.softs.index')->with('success', 'La boisson a été créé avec succès.');
    }

    public function edit(string $id)
    {
        $this->authorize('update', Soft::class);

        $soft = Soft::findOrFail($id);
        $statusChecked = old('status', $soft->status) ? 'checked' : '';
        $allergenes = Allergene::all();
        $softAllergenes = $soft->allergenes->pluck('id')->toArray();

        return view('admin.softs.edit', compact(
            'soft', 
            'allergenes', 
            'softAllergenes',
            'statusChecked'
        ));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Soft::class);

        $request->validate([
            'nom' => 'required',
            'prix' => 'nullable|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le nom de la boisson est obligatoire.',
            'prix.numeric' => 'Le prix de la boisson doit être un nombre.',
            'prix.min' => 'Le prix de la boisson ne peut pas être négatif.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
            'allergenes.array' => 'Les allergènes doivent être sélectionnés sous forme de tableau.',
        ]);
    
        $soft = Soft::findOrFail($id);
        $soft->nom = $request->nom;
        $soft->prix = $request->prix;
        $soft->info_supp = $request->info_supp;
        $soft->status = $request->status;

            // Gérer l'image
        if ($request->hasFile('photo')) {
            // Supprimer les anciens fichiers d'image s'ils existent
            if($soft->photo_portrait && $soft->photo_thumbnail) {
                $portraitPath = public_path('storage/softs/portraits/' . $soft->photo_portrait);
                $thumbnailPath = public_path('storage/softs/thumbnails/' . $soft->photo_thumbnail);
    
                if (file_exists($portraitPath)) {
                    unlink($portraitPath);
                }
    
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = uniqid('soft_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/softs/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/softs/thumbnails/' . $photoName));

            // Mettre à jour les noms des fichiers dans la base de données
            $soft->photo_portrait = $photoName;
            $soft->photo_thumbnail = $photoName;
        } elseif ($request->has('supprimer_photo')) {
            // Supprimer les fichiers d'image existants
            $portraitPath = public_path('storage/softs/portraits/' . $soft->photo_portrait);
            $thumbnailPath = public_path('storage/softs/thumbnails/' . $soft->photo_thumbnail);

            if (file_exists($portraitPath)) {
                unlink($portraitPath);
            }

            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            // Effacer les noms des fichiers dans la base de données
            $soft->photo_portrait = null;
            $soft->photo_thumbnail = null;
        }

        $soft->save();

        if ($request->filled('allergenes')) {
            $soft->allergenes()->sync($request->input('allergenes'));
        } else {
            $soft->allergenes()->detach();
        }
    
        return redirect()->route('admin.softs.index')->with('success', 'La boisson a été modifié avec succès.');
    }
    
    public function trash()
    {
        $this->authorize('viewInTrash', Soft::class);

        $trashedSofts = Soft::onlyTrashed()->get();

        return view('admin.softs.trash', compact('trashedSofts'));
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('softDelete', Soft::class);

        $softIds = json_decode($request->input('selectedSofts', '[]'), true);
       
        if (!is_array($softIds)) {
            $softIds = [$softIds];
        }

        $count = count($softIds);
        // dd($count);
        if ($count > 0) {
            Soft::whereIn('id', $softIds)->delete();
        
            return redirect()->route('admin.softs.index')
                ->with('success', 'Boisson(s) supprimée(s) avec succès.');
        }
    
        return redirect()->route('admin.softs.index')
            ->with('error', 'Aucune boisson sélectionnée.');
    }

    public function forceDestroyMultiple(Request $request)
    {
  
        $this->authorize('forceDelete', Soft::class);

        $softIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($softIds)) {
            $softIds = [$softIds];
        }
        $softIds = array_map('intval', $softIds);
        $count = count($softIds);

        if ($count > 0) {
            $softsWithTrashed = Soft::withTrashed()->whereIn('id', $softIds)->get();
            foreach ($softsWithTrashed as $soft) {

                $portraitPath = public_path('storage/softs/portraits/' . $soft->photo_portrait);
                $thumbnailPath = public_path('storage/softs/thumbnails/' . $soft->photo_thumbnail);
    
                if ($portraitPath && File::exists($portraitPath)) {
                    File::delete($portraitPath);
                }
                
                if ($thumbnailPath && File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }

                // $alcool->forceDelete();
            }
            Soft::whereIn('id', $softIds)->forceDelete();
        
            return redirect()->route('admin.softs.index')
                ->with('success', 'Boisson(s) supprimée(s) avec succès.');
        }
    
        return redirect()->route('admin.softs.index')
            ->with('error', 'Aucune boisson sélectionnée.');
    }

    public function restoreMultiple(Request $request)
    {
        $this->authorize('restore', Soft::class);

        $softIds = json_decode($request->input('selectedItems'));

        if (!is_array($softIds)) {
            $softIds = [$softIds];
        }

        $count = count($softIds);

        if ($count > 0) {
            Soft::whereIn('id', $softIds)->restore();
        
            return redirect()->route('admin.softs.index')
                ->with('success', 'Boisson(s) restaurée(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucune boisson sélectionnée.');
    }
}
