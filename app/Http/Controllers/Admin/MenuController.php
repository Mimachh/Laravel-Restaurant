<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Entree;
use App\Models\Plat;
use App\Models\Dessert;
use App\Models\Vin;
use App\Models\Soft;
use App\Models\Alcool;

class MenuController extends Controller
{
    public function index() {

        $this->authorize('viewAny', Menu::class);
        $menus = Menu::with('entrees')->get();

        // $menus = Menu::all();

        $trashedMenus = Menu::onlyTrashed()->get();

        return view('admin.menus.index', compact('menus', 'trashedMenus'));
    }

    public function create() {
        $this->authorize('create', Menu::class);
        $entrees = Entree::where('status', 1)->get();
        $plats = Plat::where('status', 1)->get();
        $desserts = Dessert::where('status', 1)->get();

        $vins = Vin::where('status', 1)->get();
        $softs = Soft::where('status', 1)->get();
        $alcools = Alcool::where('status', 1)->get();

        return view('admin.menus.create', compact(
            'entrees', 
            'plats',
            'desserts',
            'vins',
            'softs',
            'alcools'
        ));
    }

    public function store(Request $request) {

        $this->authorize('create', Menu::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'info_supp' => 'nullable',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'description.required' => 'Le champ "Description" est requis.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
        ]);

        $menu = new Menu();
        $menu->nom = $validatedData['nom'];
        $menu->description = $validatedData['description'];
        $menu->info_supp = $validatedData['info_supp'];
        $menu->status = $validatedData['status'];
        $menu->save();

        $entrees = $request->input('entrees');
        if(!empty($entrees)) {
            $menu->entrees()->attach($entrees);
        }

        $plats = $request->input('plats');
        if(!empty($plats)) {
            $menu->plats()->attach($plats);
        }

        $desserts = $request->input('desserts');
        if(!empty($desserts)) {
            $menu->desserts()->attach($desserts);
        }

        $vins = $request->input('vins');
        if(!empty($vins)) {
            $menu->vins()->attach($vins);
        }

        $softs = $request->input('softs');
        if(!empty($softs)) {
            $menu->softs()->attach($softs);
        }

        $alcools = $request->input('alcools');
        if(!empty($alcools)) {
            $menu->alcools()->attach($alcools);
        }

        return redirect()->route('admin.menus.index')->with('success', 'Le menu a été créé avec succès.');
    }

    public function edit(string $id) {
        $this->authorize('update', Menu::class);

        $menu = Menu::findOrFail($id);
        $entrees = Entree::where('status', 1)->get();
        $menuEntrees = $menu->entrees->pluck('id')->toArray();

        $plats = Plat::where('status', 1)->get();
        $menuPlats = $menu->plats->pluck('id')->toArray();

        $desserts = Dessert::where('status', 1)->get();
        $menuDesserts = $menu->desserts->pluck('id')->toArray();

        $vins = Vin::where('status', 1)->get();
        $menuVins = $menu->vins->pluck('id')->toArray();

        $softs = Soft::where('status', 1)->get();
        $menuSofts = $menu->softs->pluck('id')->toArray();

        $alcools = Alcool::where('status', 1)->get();
        $menuAlcools = $menu->alcools->pluck('id')->toArray();

        $statusChecked = old('status', $menu->status) ? 'checked' : '';

        return view('admin.menus.edit', 
        compact(
        'menu', 
        'statusChecked', 
        'entrees', 
        'menuEntrees',
        'plats',
        'menuPlats',
        'desserts',
        'menuDesserts',
        'vins',
        'menuVins',
        'softs',
        'menuSofts',
        'alcools',
        'menuAlcools'
        ));
    }

    public function update(Request $request, $id) {

        $this->authorize('update', Menu::class);

        $validatedData = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'info_supp' => 'nullable',
            'status' => 'nullable|numeric'
        ], [
            'nom.required' => 'Le champ "Nom" est requis.',
            'description.required' => 'Le champ "Description" est requis.',
            'status.numeric' => 'Le statut doit être vrai ou faux',
            'info_supp.required' => 'Le champ "Informations supplémentaires" est requis.',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->nom = $validatedData['nom'];
        $menu->description = $validatedData['description'];
        $menu->info_supp = $validatedData['info_supp'];
        $menu->status = $request->status;
        $menu->save();

        if ($request->filled('entrees')) {
            $menu->entrees()->sync($request->input('entrees'));
        } else {
            $menu->entrees()->detach();
        }

        if ($request->filled('plats')) {
            $menu->plats()->sync($request->input('plats'));
        } else {
            $menu->plats()->detach();
        }

        if ($request->filled('desserts')) {
            $menu->desserts()->sync($request->input('desserts'));
        } else {
            $menu->desserts()->detach();
        }

        if ($request->filled('vins')) {
            $menu->vins()->sync($request->input('vins'));
        } else {
            $menu->vins()->detach();
        }

        if ($request->filled('softs')) {
            $menu->softs()->sync($request->input('softs'));
        } else {
            $menu->softs()->detach();
        }

        if ($request->filled('alcools')) {
            $menu->alcools()->sync($request->input('alcools'));
        } else {
            $menu->alcools()->detach();
        }

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
