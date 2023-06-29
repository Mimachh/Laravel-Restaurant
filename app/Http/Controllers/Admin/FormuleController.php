<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formule;

class FormuleController extends Controller
{
    public function index() {

        $this->authorize('viewAny', Formule::class);
        // $menus = Menu::with('allergenes')->get();

        $formules = Formule::all();

        $trashedFormules = Formule::onlyTrashed()->get();

        return view('admin.formules.index', compact('formules', 'trashedFormules'));
    }

    public function create() {
        $this->authorize('create', Formule::class);

        return view('admin.formules.create');
    }

    public function store(Request $request) {

        $this->authorize('create', Formule::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'nullable',
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.required' => 'Le prix du plat est obligatoire.',
            'prix.numeric' => 'Le prix du plat doit être un nombre.',
            'prix.min' => 'Le prix du plat ne peut pas être négatif.',
            'description.required' => 'Le champ "Description" est requis.',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
        ]);

        $formule = new Formule();
        $formule->nom = $validatedData['nom'];
        $formule->description = $validatedData['description'];
        $formule->prix = $validatedData['prix'];
        $formule->info_supp = $validatedData['info_supp'];
        $formule->save();

        return redirect()->route('admin.formules.index')->with('success', 'Le formule a été créé avec succès.');
    }

    public function edit(string $id) {
        $this->authorize('update', Formule::class);

        $formule = Formule::findOrFail($id);


        return view('admin.formules.edit', compact('formule'));
    }

    public function update(Request $request, $id) {

        $this->authorize('update', Formule::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric|min:0',
            'info_supp' => 'nullable',
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'prix.required' => 'Le prix du plat est obligatoire.',
            'prix.numeric' => 'Le prix du plat doit être un nombre.',
            'prix.min' => 'Le prix du plat ne peut pas être négatif.',
            'description.required' => 'Le champ "Description" est requis.',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
        ]);

        $formule = Formule::findOrFail($id);
        $formule->prix = $validatedData['prix'];
        $formule->nom = $validatedData['nom'];
        $formule->description = $validatedData['description'];
        $formule->info_supp = $validatedData['info_supp'];
        $formule->save();

        return redirect()->route('admin.formules.index')->with('success', 'Le formule a été modifié avec succès.');
    }

    public function trash() {

        $this->authorize('viewInTrash', Formule::class);

        $trashedFormules = Formule::onlyTrashed()->get();

        return view('admin.formules.trash', compact('trashedFormules'));
    }

    public function destroyMultiple(Request $request) {
        $this->authorize('softDelete', Formule::class);

        $formuleIds = json_decode($request->input('selectedFormules', '[]'), true);
       
        if (!is_array($formuleIds)) {
            $formuleIds = [$formuleIds];
        }

        $count = count($formuleIds);
        // dd($count);
        if ($count > 0) {
            Formule::whereIn('id', $formuleIds)->delete();
        
            return redirect()->route('admin.formules.index')
                ->with('success', 'Formule(s) supprimée(s) avec succès.');
        }
    
        return redirect()->route('admin.formules.index')
            ->with('error', 'Aucune formule sélectionnée.');
    }

    public function forceDestroyMultiple(Request $request)
    {
        $this->authorize('forceDelete', Formule::class);

        $formuleIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($formuleIds)) {
            $formuleIds = [$formuleIds];
        }

        $count = count($formuleIds);
        // dd($count);
        if ($count > 0) {
            Formule::whereIn('id', $formuleIds)->forceDelete();
        
            return redirect()->route('admin.formules.index')
                ->with('success', 'Formule(s) supprimée(s) avec succès.');
        }
    
        return redirect()->route('admin.formules.index')
            ->with('error', 'Aucune formule sélectionnée.');
    }

    public function restoreMultiple(Request $request) {

        $this->authorize('restore', Formule::class);

        $formuleIds = json_decode($request->input('selectedItems'));

        if (!is_array($formuleIds)) {
            $formuleIds = [$formuleIds];
        }

        $count = count($formuleIds);

        if ($count > 0) {
            Formule::whereIn('id', $formuleIds)->restore();
        
            return redirect()->route('admin.formules.index')
                ->with('success', 'Formule(s) restaurée(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucune formule sélectionnée.');
    }
}
