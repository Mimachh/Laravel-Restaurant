<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Plat;

class PlatController extends Controller
{

    use SoftDeletes;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Plat::class);

        $plats = Plat::all();

        $trashedPlats = Plat::onlyTrashed()->get();

        return view('admin.plats.index', compact('plats', 'trashedPlats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Plat::class);

        return view('admin.plats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create', Plat::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'required',
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'description.required' => 'Le champ "Description" est requis.',
            'prix.required' => 'Le champ "Prix" est requis.',
            'prix.numeric' => 'Le champ "Prix" doit être un nombre.',
            'prix.min' => 'Le champ "Prix" doit être supérieur ou égal à 0.',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
        ]);

        // Créer le plat en utilisant les données validées
        $plat = new Plat();
        $plat->nom = $validatedData['nom'];
        $plat->description = $validatedData['description'];
        $plat->prix = $validatedData['prix'];
        $plat->info_supp = $validatedData['info_supp'];
        $plat->save();

        return redirect()->route('admin.plats.index')->with('success', 'Le plat a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Plat::class);

        $plat = Plat::findOrFail($id);
        return view('admin.plats.edit', compact('plat'));
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
        ], [
            'nom.required' => 'Le nom du plat est obligatoire.',
            'description.required' => 'La description du plat est obligatoire.',
            'prix.required' => 'Le prix du plat est obligatoire.',
            'prix.numeric' => 'Le prix du plat doit être un nombre.',
            'prix.min' => 'Le prix du plat ne peut pas être négatif.',
            'info_supp.required' => 'Les informations supplémentaires du plat sont obligatoires.',
        ]);
    
        $plat = Plat::findOrFail($id);
        $plat->nom = $request->nom;
        $plat->description = $request->description;
        $plat->prix = $request->prix;
        $plat->info_supp = $request->info_supp;
        $plat->save();
    
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

        $count = count($platIds);
  
        if ($count > 0) {
            Plat::whereIn('id', $platIds)->forceDelete();
        
            return redirect()->route('admin.plats.index')
                ->with('success', 'Plat(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.users.index')
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

        return redirect()->back()->with('error', 'Aucun plat sélectionné.');;
    }
}
