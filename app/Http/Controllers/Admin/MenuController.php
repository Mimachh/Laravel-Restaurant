<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
class MenuController extends Controller
{
    public function index() {

        $this->authorize('viewAny', Menu::class);
        // $menus = Menu::with('allergenes')->get();

        $menus = Menu::all();

        $trashedMenus = Menu::onlyTrashed()->get();

        return view('admin.menus.index', compact('menus', 'trashedMenus'));
    }

    public function create() {
        $this->authorize('create', Menu::class);

        return view('admin.menus.create');
    }

    public function store(Request $request) {

        $this->authorize('create', Menu::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'info_supp' => 'nullable',
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'description.required' => 'Le champ "Description" est requis.',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
        ]);

        $menu = new Menu();
        $menu->nom = $validatedData['nom'];
        $menu->description = $validatedData['description'];
        $menu->info_supp = $validatedData['info_supp'];
        $menu->save();

        return redirect()->route('admin.menus.index')->with('success', 'Le menu a été créé avec succès.');
    }

    public function edit(string $id) {
        $this->authorize('update', Menu::class);

        $menu = Menu::findOrFail($id);


        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id) {

        $this->authorize('update', Menu::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'info_supp' => 'nullable',
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'description.required' => 'Le champ "Description" est requis.',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->nom = $validatedData['nom'];
        $menu->description = $validatedData['description'];
        $menu->info_supp = $validatedData['info_supp'];
        $menu->save();

        return redirect()->route('admin.menus.index')->with('success', 'Le menu a été modifié avec succès.');
    }

    public function trash() {

        $this->authorize('viewInTrash', Menu::class);

        $trashedMenus = Menu::onlyTrashed()->get();

        return view('admin.menus.trash', compact('trashedMenus'));
    }

    public function destroyMultiple(Request $request) {
        $this->authorize('softDelete', Menu::class);

        $menuIds = json_decode($request->input('selectedMenus', '[]'), true);
       
        if (!is_array($menuIds)) {
            $menuIds = [$menuIds];
        }

        $count = count($menuIds);
        // dd($count);
        if ($count > 0) {
            Menu::whereIn('id', $menuIds)->delete();
        
            return redirect()->route('admin.menus.index')
                ->with('success', 'Menu(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.menus.index')
            ->with('error', 'Aucun menu sélectionné.');
    }

    public function forceDestroyMultiple(Request $request)
    {
        $this->authorize('forceDelete', Menu::class);

        $menuIds = json_decode($request->input('selectedItems', '[]'), true);
        
        if (!is_array($menuIds)) {
            $menuIds = [$menuIds];
        }

        $count = count($menuIds);
        // dd($count);
        if ($count > 0) {
            Menu::whereIn('id', $menuIds)->forceDelete();
        
            return redirect()->route('admin.menus.index')
                ->with('success', 'Menu(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.menus.index')
            ->with('error', 'Aucun menu sélectionné.');
    }

    public function restoreMultiple(Request $request) {

        $this->authorize('restore', Menu::class);

        $menuIds = json_decode($request->input('selectedItems'));

        if (!is_array($menuIds)) {
            $menuIds = [$menuIds];
        }

        $count = count($menuIds);

        if ($count > 0) {
            Menu::whereIn('id', $menuIds)->restore();
        
            return redirect()->route('admin.menus.index')
                ->with('success', 'Menu(s) restauré(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucun menu sélectionné.');
    }
}
