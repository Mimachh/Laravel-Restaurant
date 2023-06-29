<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Allergene;
use App\Models\Entree;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class EntreeController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Entree::class);

        $entrees = Entree::with('allergenes')->get();

        $trashedEntrees = Entree::onlyTrashed()->get();

        return view('admin.entrees.index', compact('entrees', 'trashedEntrees'));
    }

    public function create()
    {
        $this->authorize('create', Entree::class);
        $allergenes = Allergene::all();

        return view('admin.entrees.create', compact('allergenes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create', Entree::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.required' => 'Le champ "Prix" est requis.',
            'prix.numeric' => 'Le champ "Prix" doit être un nombre.',
            'prix.min' => 'Le champ "Prix" doit être supérieur ou égal à 0.',
            'allergenes.array' => 'Les allergènes doivent être de type tableau.'
        ]);

        // Créer le plat en utilisant les données validées
        $entree = new Entree();
        $entree->nom = $validatedData['nom'];
        $entree->description = $validatedData['description'];
        $entree->prix = $validatedData['prix'];
        $entree->info_supp = $validatedData['info_supp'];
       

        // Enregistrement de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Générer un nom unique pour la photo
            $photoName = uniqid('entree_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/entrees/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/entrees/thumbnails/' . $photoName));

            // Enregistrer les noms des fichiers dans la base de données
            $entree->photo_portrait = $photoName;
            $entree->photo_thumbnail = $photoName;
        }
  
        $entree->save();

        $allergenes = $request->input('allergenes');
        if(!empty($allergenes)) {
            $entree->allergenes()->attach($allergenes);
        }

        return redirect()->route('admin.entrees.index')->with('success', 'L\'entrée a été créé avec succès.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Entree::class);

        $entree = Entree::findOrFail($id);
        $allergenes = Allergene::all();
        $entreeAllergenes = $entree->allergenes->pluck('id')->toArray();

        return view('admin.entrees.edit', compact('entree', 'allergenes', 'entreeAllergenes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Plat::class);

        $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array',
        ], [
            'nom.required' => 'Le nom de l\'entrée est obligatoire.',
            'prix.required' => 'Le prix de l\'entrée est obligatoire.',
            'prix.numeric' => 'Le prix de l\'entrée doit être un nombre.',
            'prix.min' => 'Le prix de l\'entrée ne peut pas être négatif.',
            'allergenes.array' => 'Les allergènes doivent être sélectionnés sous forme de tableau.',
        ]);
    
        $entree = Entree::findOrFail($id);
        $entree->nom = $request->nom;
        $entree->description = $request->description;
        $entree->prix = $request->prix;
        $entree->info_supp = $request->info_supp;

            // Gérer l'image
        if ($request->hasFile('photo')) {
            // Supprimer les anciens fichiers d'image s'ils existent
            if($entree->photo_portrait && $entree->photo_thumbnail) {
                $portraitPath = public_path('storage/entrees/portraits/' . $entree->photo_portrait);
                $thumbnailPath = public_path('storage/entrees/thumbnails/' . $entree->photo_thumbnail);
    
                if (file_exists($portraitPath)) {
                    unlink($portraitPath);
                }
    
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = uniqid('entree_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/entrees/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/entrees/thumbnails/' . $photoName));

            // Mettre à jour les noms des fichiers dans la base de données
            $entree->photo_portrait = $photoName;
            $entree->photo_thumbnail = $photoName;
        } elseif ($request->has('supprimer_photo')) {
            // Supprimer les fichiers d'image existants
            $portraitPath = public_path('storage/entrees/portraits/' . $entree->photo_portrait);
            $thumbnailPath = public_path('storage/entrees/thumbnails/' . $entree->photo_thumbnail);

            if (file_exists($portraitPath)) {
                unlink($portraitPath);
            }

            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            // Effacer les noms des fichiers dans la base de données
            $entree->photo_portrait = null;
            $entree->photo_thumbnail = null;
        }

        $entree->save();

        if ($request->filled('allergenes')) {
            $entree->allergenes()->sync($request->input('allergenes'));
        } else {
            $entree->allergenes()->detach();
        }
    
        return redirect()->route('admin.entrees.index')->with('success', 'L\'entrée a été modifié avec succès.');
    }

    public function trash()
    {
        $this->authorize('viewInTrash', Entree::class);

        $trashedEntrees = Entree::onlyTrashed()->get();

        return view('admin.entrees.trash', compact('trashedEntrees'));
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('softDelete', Entree::class);

        $entreeIds = json_decode($request->input('selectedEntrees', '[]'), true);
       
        if (!is_array($entreeIds)) {
            $entreeIds = [$entreeIds];
        }

        $count = count($entreeIds);
        // dd($count);
        if ($count > 0) {
            Entree::whereIn('id', $entreeIds)->delete();
        
            return redirect()->route('admin.entrees.index')
                ->with('success', 'Entrée(s) supprimée(s) avec succès.');
        }
    
        return redirect()->route('admin.entrees.index')
            ->with('error', 'Aucune entrée sélectionnée.');
    }

    public function forceDestroyMultiple(Request $request)
    {
  
        $this->authorize('forceDelete', Entree::class);

        $entreeIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($entreeIds)) {
            $entreeIds = [$entreeIds];
        }
        $entreeIds = array_map('intval', $entreeIds);
        $count = count($entreeIds);
        // dd($count);
        if ($count > 0) {

            $entreesWithTrashed = Entree::withTrashed()->whereIn('id', $entreeIds)->get();
            foreach ($entreesWithTrashed as $entree) {
     

                $portraitPath = public_path('storage/entrees/portraits/' . $entree->photo_portrait);
                $thumbnailPath = public_path('storage/entrees/thumbnails/' . $entree->photo_thumbnail);
    
                if ($portraitPath && File::exists($portraitPath)) {
                    File::delete($portraitPath);
                }
                
                if ($thumbnailPath && File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }
            Entree::whereIn('id', $entreeIds)->forceDelete();
        
            return redirect()->route('admin.entrees.index')
                ->with('success', 'Entrée(s) supprimée(s) avec succès.');
        }
    
        return redirect()->route('admin.entrees.index')
            ->with('error', 'Aucune entrée sélectionnée.');
    }

    public function restoreMultiple(Request $request)
    {
        $this->authorize('restore', Plat::class);

        $entreeIds = json_decode($request->input('selectedItems'));

        if (!is_array($entreeIds)) {
            $entreeIds = [$entreeIds];
        }

        $count = count($entreeIds);

        if ($count > 0) {
            Entree::whereIn('id', $entreeIds)->restore();
        
            return redirect()->route('admin.entrees.index')
                ->with('success', 'Entrée(s) restaurée(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucune entrée sélectionnée.');
    }
}
