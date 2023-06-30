<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Plat;
use App\Models\Allergene;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class PlatController extends Controller
{

    use SoftDeletes;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Plat::class);

        $plats = Plat::with('allergenes')->get();

        $trashedPlats = Plat::onlyTrashed()->get();

        return view('admin.plats.index', compact('plats', 'trashedPlats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Plat::class);
        $allergenes = Allergene::all();

        return view('admin.plats.create', compact('allergenes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create', Plat::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'nullable',
            'allergenes' => 'array',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.required' => 'Le champ "Prix" est requis.',
            'prix.numeric' => 'Le champ "Prix" doit être un nombre.',
            'prix.min' => 'Le champ "Prix" doit être supérieur ou égal à 0.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
            'allergenes.array' => 'Les allergènes doivent être de type tableau.'
        ]);

        // Créer le plat en utilisant les données validées
        $plat = new Plat();
        $plat->nom = $validatedData['nom'];
        $plat->description = $validatedData['description'];
        $plat->prix = $validatedData['prix'];
        $plat->info_supp = $validatedData['info_supp'];
        $plat->status = $validatedData['status'];
       

        // Enregistrement de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Générer un nom unique pour la photo
            $photoName = uniqid('plat_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/plats/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/plats/thumbnails/' . $photoName));

            // Enregistrer les noms des fichiers dans la base de données
            $plat->photo_portrait = $photoName;
            $plat->photo_thumbnail = $photoName;
        }
  
        $plat->save();

        $allergenes = $request->input('allergenes');
        if(!empty($allergenes)) {
            $plat->allergenes()->attach($allergenes);
        }

        return redirect()->route('admin.plats.index')->with('success', 'Le plat a été créé avec succès.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Plat::class);

        $plat = Plat::findOrFail($id);
        $statusChecked = old('status', $plat->status) ? 'checked' : '';
        $allergenes = Allergene::all();
        $platAllergenes = $plat->allergenes->pluck('id')->toArray();

        return view('admin.plats.edit', compact(
            'plat', 
            'allergenes', 
            'platAllergenes',
            'statusChecked'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Plat::class);

        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'required',
            'allergenes' => 'array',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le nom du plat est obligatoire.',
            'description.required' => 'La description du plat est obligatoire.',
            'prix.required' => 'Le prix du plat est obligatoire.',
            'prix.numeric' => 'Le prix du plat doit être un nombre.',
            'prix.min' => 'Le prix du plat ne peut pas être négatif.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
            'info_supp.required' => 'Les informations supplémentaires du plat sont obligatoires.',
            'allergenes.array' => 'Les allergènes doivent être sélectionnés sous forme de tableau.',
        ]);
    
        $plat = Plat::findOrFail($id);
        $plat->nom = $request->nom;
        $plat->description = $request->description;
        $plat->prix = $request->prix;
        $plat->info_supp = $request->info_supp;
        $plat->status = $request->status;

            // Gérer l'image
        if ($request->hasFile('photo')) {
            // Supprimer les anciens fichiers d'image s'ils existent
            if($plat->photo_portrait && $plat->photo_thumbnail) {
                $portraitPath = public_path('storage/plats/portraits/' . $plat->photo_portrait);
                $thumbnailPath = public_path('storage/plats/thumbnails/' . $plat->photo_thumbnail);
    
                if (file_exists($portraitPath)) {
                    unlink($portraitPath);
                }
    
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = uniqid('plat_') . '.' . $photo->getClientOriginalExtension();

            // Redimensionner et enregistrer l'image portrait
            $portraitImage = Image::make($photo)->fit(16 * 100, 9 * 100, function ($constraint) {
                $constraint->upsize();
            });
            $portraitImage->save(public_path('storage/plats/portraits/' . $photoName));

            // Redimensionner et enregistrer la miniature (thumbnail) de l'image
            $thumbnailImage = Image::make($photo)->fit(300, 300);
            $thumbnailImage->save(public_path('storage/plats/thumbnails/' . $photoName));

            // Mettre à jour les noms des fichiers dans la base de données
            $plat->photo_portrait = $photoName;
            $plat->photo_thumbnail = $photoName;
        } elseif ($request->has('supprimer_photo')) {
            // Supprimer les fichiers d'image existants
            $portraitPath = public_path('storage/plats/portraits/' . $plat->photo_portrait);
            $thumbnailPath = public_path('storage/plats/thumbnails/' . $plat->photo_thumbnail);

            if (file_exists($portraitPath)) {
                unlink($portraitPath);
            }

            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            // Effacer les noms des fichiers dans la base de données
            $plat->photo_portrait = null;
            $plat->photo_thumbnail = null;
        }

        $plat->save();

        if ($request->filled('allergenes')) {
            $plat->allergenes()->sync($request->input('allergenes'));
        } else {
            $plat->allergenes()->detach();
        }
    
        return redirect()->route('admin.plats.index')->with('success', 'Le plat a été modifié avec succès.');
    }

    public function trash()
    {
        $this->authorize('viewInTrash', Plat::class);

        $trashedPlats = Plat::onlyTrashed()->get();

        return view('admin.plats.trash', compact('trashedPlats'));
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('softDelete', Plat::class);

        $platIds = json_decode($request->input('selectedPlats', '[]'), true);
       
        if (!is_array($platIds)) {
            $platIds = [$platIds];
        }

        $count = count($platIds);
        // dd($count);
        if ($count > 0) {
            Plat::whereIn('id', $platIds)->delete();
        
            return redirect()->route('admin.plats.index')
                ->with('success', 'Plat(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.plats.index')
            ->with('error', 'Aucun plat sélectionné.');
    }

    public function forceDestroyMultiple(Request $request)
    {
  
        $this->authorize('forceDelete', Plat::class);

        $platIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($platIds)) {
            $platIds = [$platIds];
        }
        $platIds = array_map('intval', $platIds);
        $count = count($platIds);
        // dd($count);
        if ($count > 0) {
            // $plats = Plat::whereIn('id', $platIds)->get();
            // dd(Plat::withTrashed()->whereIn('id', $platIds)->get());
            $platsWithTrashed = Plat::withTrashed()->whereIn('id', $platIds)->get();
            foreach ($platsWithTrashed as $plat) {
                // Supprimer les fichiers d'image du plat
                // Storage::delete([
                //     'plats/portraits/' . $plat->photo_portrait,
                //     'plats/thumbnails/' . $plat->photo_thumbnail
                // ]);

                $portraitPath = public_path('storage/plats/portraits/' . $plat->photo_portrait);
                $thumbnailPath = public_path('storage/plats/thumbnails/' . $plat->photo_thumbnail);
    
                if ($portraitPath && File::exists($portraitPath)) {
                    File::delete($portraitPath);
                }
                
                if ($thumbnailPath && File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }

                // $plat->forceDelete();
            }
            Plat::whereIn('id', $platIds)->forceDelete();
        
            return redirect()->route('admin.plats.index')
                ->with('success', 'Plat(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.plats.index')
            ->with('error', 'Aucun plat sélectionné.');
    }

    public function restoreMultiple(Request $request)
    {
        $this->authorize('restore', Plat::class);

        $platIds = json_decode($request->input('selectedItems'));

        if (!is_array($platIds)) {
            $platIds = [$platIds];
        }

        $count = count($platIds);

        if ($count > 0) {
            Plat::whereIn('id', $platIds)->restore();
        
            return redirect()->route('admin.plats.index')
                ->with('success', 'Plat(s) restauré(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucun plat sélectionné.');
    }
}
