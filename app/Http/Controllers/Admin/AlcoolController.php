<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use App\Models\Alcool;
use App\Models\Allergene;

class AlcoolController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Alcool::class);

        $alcools = Alcool::with('allergenes')->get();

        $trashedAlcools = Alcool::onlyTrashed()->get();

        return view('admin.alcools.index', compact('alcools', 'trashedAlcools'));
    }

    public function create()
    {
        $this->authorize('create', Alcool::class);
        $allergenes = Allergene::all();

        return view('admin.alcools.create', compact('allergenes'));
    }

    public function store(Request $request)
    {

        $this->authorize('create', Alcool::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'prix' => 'nullable|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.required' => 'Le champ "Prix" est requis.',
            'prix.numeric' => 'Le champ "Prix" doit être un nombre.',
            'prix.min' => 'Le champ "Prix" doit être supérieur ou égal à 0.',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
            'allergenes.array' => 'Les allergènes doivent être de type tableau.'
        ]);

        // Créer le plat en utilisant les données validées
        $alcool = new Alcool();
        $alcool->nom = $validatedData['nom'];
        $alcool->prix = $validatedData['prix'];
        $alcool->info_supp = $validatedData['info_supp'];
       

        // Enregistrement de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Générer un nom unique pour la photo
            $photoName = uniqid('alcool_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/alcools/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/alcools/thumbnails/' . $photoName));

            // Enregistrer les noms des fichiers dans la base de données
            $alcool->photo_portrait = $photoName;
            $alcool->photo_thumbnail = $photoName;
        }
  
        $alcool->save();

        $allergenes = $request->input('allergenes');
        if(!empty($allergenes)) {
            $alcool->allergenes()->attach($allergenes);
        }

        return redirect()->route('admin.alcools.index')->with('success', 'La boisson alcoolisée a été créé avec succès.');
    }

    public function edit(string $id)
    {
        $this->authorize('update', Alcool::class);

        $alcool = Alcool::findOrFail($id);
        $statusChecked = old('status', $alcool->status) ? 'checked' : '';
        $allergenes = Allergene::all();
        $alcoolAllergenes = $alcool->allergenes->pluck('id')->toArray();

        return view('admin.alcools.edit', compact(
            'alcool', 
            'allergenes', 
            'alcoolAllergenes', 
            'statusChecked',
        ));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Alcool::class);

        $request->validate([
            'nom' => 'required',
            'prix' => 'nullable|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array',
        ], [
            'nom.required' => 'Le nom de la boisson est obligatoire.',
            'prix.numeric' => 'Le prix de la boisson doit être un nombre.',
            'prix.min' => 'Le prix de la boisson ne peut pas être négatif.',
            'allergenes.array' => 'Les allergènes doivent être sélectionnés sous forme de tableau.',
        ]);
    
        $alcool = Alcool::findOrFail($id);
        $alcool->nom = $request->nom;
        $alcool->prix = $request->prix;
        $alcool->info_supp = $request->info_supp;

            // Gérer l'image
        if ($request->hasFile('photo')) {
            // Supprimer les anciens fichiers d'image s'ils existent
            if($alcool->photo_portrait && $alcool->photo_thumbnail) {
                $portraitPath = public_path('storage/alcools/portraits/' . $alcool->photo_portrait);
                $thumbnailPath = public_path('storage/alcools/thumbnails/' . $alcool->photo_thumbnail);
    
                if (file_exists($portraitPath)) {
                    unlink($portraitPath);
                }
    
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = uniqid('alcool_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/alcools/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/alcools/thumbnails/' . $photoName));

            // Mettre à jour les noms des fichiers dans la base de données
            $alcool->photo_portrait = $photoName;
            $alcool->photo_thumbnail = $photoName;
        } elseif ($request->has('supprimer_photo')) {
            // Supprimer les fichiers d'image existants
            $portraitPath = public_path('storage/alcools/portraits/' . $alcool->photo_portrait);
            $thumbnailPath = public_path('storage/alcools/thumbnails/' . $alcool->photo_thumbnail);

            if (file_exists($portraitPath)) {
                unlink($portraitPath);
            }

            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            // Effacer les noms des fichiers dans la base de données
            $alcool->photo_portrait = null;
            $alcool->photo_thumbnail = null;
        }

        $alcool->save();

        if ($request->filled('allergenes')) {
            $alcool->allergenes()->sync($request->input('allergenes'));
        } else {
            $alcool->allergenes()->detach();
        }
    
        return redirect()->route('admin.alcools.index')->with('success', 'La boisson alcoolisée a été modifié avec succès.');
    }

    public function trash()
    {
        $this->authorize('viewInTrash', Alcool::class);

        $trashedAlcools = Alcool::onlyTrashed()->get();

        return view('admin.alcools.trash', compact('trashedAlcools'));
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('softDelete', Alcool::class);

        $alcoolIds = json_decode($request->input('selectedAlcools', '[]'), true);
       
        if (!is_array($alcoolIds)) {
            $alcoolIds = [$alcoolIds];
        }

        $count = count($alcoolIds);
        // dd($count);
        if ($count > 0) {
            Alcool::whereIn('id', $alcoolIds)->delete();
        
            return redirect()->route('admin.alcools.index')
                ->with('success', 'Alcool(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.alcools.index')
            ->with('error', 'Aucun alcool sélectionné.');
    }

    public function forceDestroyMultiple(Request $request)
    {
  
        $this->authorize('forceDelete', Alcool::class);

        $alcoolIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($alcoolIds)) {
            $alcoolIds = [$alcoolIds];
        }
        $alcoolIds = array_map('intval', $alcoolIds);
        $count = count($alcoolIds);

        if ($count > 0) {
            $alcoolsWithTrashed = Alcool::withTrashed()->whereIn('id', $alcoolIds)->get();
            foreach ($alcoolsWithTrashed as $alcool) {

                $portraitPath = public_path('storage/alcools/portraits/' . $alcool->photo_portrait);
                $thumbnailPath = public_path('storage/alcools/thumbnails/' . $alcool->photo_thumbnail);
    
                if ($portraitPath && File::exists($portraitPath)) {
                    File::delete($portraitPath);
                }
                
                if ($thumbnailPath && File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }

                // $alcool->forceDelete();
            }
            Alcool::whereIn('id', $alcoolIds)->forceDelete();
        
            return redirect()->route('admin.alcools.index')
                ->with('success', 'Alcool(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.alcools.index')
            ->with('error', 'Aucun alcool sélectionné.');
    }

    public function restoreMultiple(Request $request)
    {
        $this->authorize('restore', Alcool::class);

        $alcoolIds = json_decode($request->input('selectedItems'));

        if (!is_array($alcoolIds)) {
            $alcoolIds = [$alcoolIds];
        }

        $count = count($alcoolIds);

        if ($count > 0) {
            Alcool::whereIn('id', $alcoolIds)->restore();
        
            return redirect()->route('admin.alcools.index')
                ->with('success', 'Alcool(s) restauré(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucun alcool sélectionné.');
    }
}
