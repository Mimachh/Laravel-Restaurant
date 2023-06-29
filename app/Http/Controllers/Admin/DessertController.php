<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use App\Models\Allergene;
use App\Models\Dessert;

class DessertController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Dessert::class);

        $desserts = Dessert::with('allergenes')->get();

        $trashedDesserts = Dessert::onlyTrashed()->get();

        return view('admin.desserts.index', compact('desserts', 'trashedDesserts'));
    }

    public function create()
    {
        $this->authorize('create', Dessert::class);
        $allergenes = Allergene::all();

        return view('admin.desserts.create', compact('allergenes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create', Dessert::class);

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
        $dessert = new Dessert();
        $dessert->nom = $validatedData['nom'];
        $dessert->description = $validatedData['description'];
        $dessert->prix = $validatedData['prix'];
        $dessert->info_supp = $validatedData['info_supp'];
       

        // Enregistrement de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Générer un nom unique pour la photo
            $photoName = uniqid('dessert_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/desserts/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/desserts/thumbnails/' . $photoName));

            // Enregistrer les noms des fichiers dans la base de données
            $dessert->photo_portrait = $photoName;
            $dessert->photo_thumbnail = $photoName;
        }
  
        $dessert->save();

        $allergenes = $request->input('allergenes');
        if(!empty($allergenes)) {
            $dessert->allergenes()->attach($allergenes);
        }

        return redirect()->route('admin.desserts.index')->with('success', 'Le dessert a été créé avec succès.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Dessert::class);

        $dessert = Dessert::findOrFail($id);
        $allergenes = Allergene::all();
        $dessertAllergenes = $dessert->allergenes->pluck('id')->toArray();

        return view('admin.desserts.edit', compact('dessert', 'allergenes', 'dessertAllergenes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Dessert::class);

        $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array',
        ], [
            'nom.required' => 'Le nom du dessert est obligatoire.',
            'prix.required' => 'Le prix du dessert est obligatoire.',
            'prix.numeric' => 'Le prix du dessert doit être un nombre.',
            'prix.min' => 'Le prix du dessert ne peut pas être négatif.',
            'allergenes.array' => 'Les allergènes doivent être sélectionnés sous forme de tableau.',
        ]);
    
        $dessert = Dessert::findOrFail($id);
        $dessert->nom = $request->nom;
        $dessert->description = $request->description;
        $dessert->prix = $request->prix;
        $dessert->info_supp = $request->info_supp;

            // Gérer l'image
        if ($request->hasFile('photo')) {
            // Supprimer les anciens fichiers d'image s'ils existent
            if($dessert->photo_portrait && $dessert->photo_thumbnail) {
                $portraitPath = public_path('storage/desserts/portraits/' . $dessert->photo_portrait);
                $thumbnailPath = public_path('storage/desserts/thumbnails/' . $dessert->photo_thumbnail);
    
                if (file_exists($portraitPath)) {
                    unlink($portraitPath);
                }
    
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = uniqid('dessert_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/desserts/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/desserts/thumbnails/' . $photoName));

            // Mettre à jour les noms des fichiers dans la base de données
            $dessert->photo_portrait = $photoName;
            $dessert->photo_thumbnail = $photoName;
        } elseif ($request->has('supprimer_photo')) {
            // Supprimer les fichiers d'image existants
            $portraitPath = public_path('storage/desserts/portraits/' . $dessert->photo_portrait);
            $thumbnailPath = public_path('storage/desserts/thumbnails/' . $dessert->photo_thumbnail);

            if (file_exists($portraitPath)) {
                unlink($portraitPath);
            }

            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            // Effacer les noms des fichiers dans la base de données
            $dessert->photo_portrait = null;
            $dessert->photo_thumbnail = null;
        }

        $dessert->save();

        if ($request->filled('allergenes')) {
            $dessert->allergenes()->sync($request->input('allergenes'));
        } else {
            $dessert->allergenes()->detach();
        }
    
        return redirect()->route('admin.desserts.index')->with('success', 'Le dessert a été modifié avec succès.');
    }

    public function trash()
    {
        $this->authorize('viewInTrash', Dessert::class);

        $trashedDesserts = Dessert::onlyTrashed()->get();

        return view('admin.desserts.trash', compact('trashedDesserts'));
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('softDelete', Dessert::class);

        $dessertIds = json_decode($request->input('selectedDesserts', '[]'), true);
       
        if (!is_array($dessertIds)) {
            $dessertIds = [$dessertIds];
        }

        $count = count($dessertIds);
        // dd($count);
        if ($count > 0) {
            Dessert::whereIn('id', $dessertIds)->delete();
        
            return redirect()->route('admin.desserts.index')
                ->with('success', 'Dessert(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.desserts.index')
            ->with('error', 'Aucun dessert sélectionné.');
    }

    public function forceDestroyMultiple(Request $request)
    {
  
        $this->authorize('forceDelete', Dessert::class);

        $dessertIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($dessertIds)) {
            $dessertIds = [$dessertIds];
        }
        $dessertIds = array_map('intval', $dessertIds);
        $count = count($dessertIds);
        // dd($count);
        if ($count > 0) {

            $dessertsWithTrashed = Dessert::withTrashed()->whereIn('id', $dessertIds)->get();
            foreach ($dessertsWithTrashed as $dessert) {
     

                $portraitPath = public_path('storage/desserts/portraits/' . $dessert->photo_portrait);
                $thumbnailPath = public_path('storage/desserts/thumbnails/' . $dessert->photo_thumbnail);
    
                if ($portraitPath && File::exists($portraitPath)) {
                    File::delete($portraitPath);
                }
                
                if ($thumbnailPath && File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }
            Dessert::whereIn('id', $dessertIds)->forceDelete();
        
            return redirect()->route('admin.desserts.index')
                ->with('success', 'Dessert(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.desserts.index')
            ->with('error', 'Aucun dessert sélectionné.');
    }

    public function restoreMultiple(Request $request)
    {
        $this->authorize('restore', Dessert::class);

        $dessertIds = json_decode($request->input('selectedItems'));

        if (!is_array($dessertIds)) {
            $dessertIds = [$dessertIds];
        }

        $count = count($dessertIds);

        if ($count > 0) {
            Dessert::whereIn('id', $dessertIds)->restore();
        
            return redirect()->route('admin.desserts.index')
                ->with('success', 'Dessert(s) restauré(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucun dessert sélectionné.');
    }
}
