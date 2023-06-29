<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Allergene;

class AllergeneController extends Controller
{

    public function index()
    {
        $allergenes = Allergene::all();
        $trashedAllergenes = Allergene::onlyTrashed()->get();
        return view('admin.allergenes.index', compact('allergenes', 'trashedAllergenes'));
    }


    public function create()
    {
        return view('admin.allergenes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:allergenes',
        ]);

        Allergene::create($request->all());

        return redirect()->route('admin.allergenes.index')->with('success', 'Allergene created successfully.');
    }

    public function edit(string $id)
    {
        $allergene = Allergene::findOrFail($id);
        return view('admin.allergenes.edit', compact('allergene'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $allergene = Allergene::findOrFail($id);
        $allergene->nom = $request->nom;
        $allergene->save();

        return redirect()->route('admin.allergenes.index')->with('success', 'Allergene updated successfully.');
    }

    public function trash()
    {
    

        $trashedAllergenes = Allergene::onlyTrashed()->get();

        return view('admin.allergenes.trash', compact('trashedAllergenes'));
    }

    public function destroyMultiple(Request $request)
    {

        $allergeneIds = json_decode($request->input('selectedAllergenes', '[]'), true);
       
        if (!is_array($allergeneIds)) {
            $allergeneIds = [$allergeneIds];
        }

        $count = count($allergeneIds);
        // dd($count);
        if ($count > 0) {
            Allergene::whereIn('id', $allergeneIds)->delete();
        
            return redirect()->route('admin.allergenes.index')
                ->with('success', 'Allergène(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.allergenes.index')
            ->with('error', 'Aucun allergène sélectionné.');
    }

    public function forceDestroyMultiple(Request $request)
    {

        $allergeneIds = json_decode($request->input('selectedItems', '[]'), true);

        if (!is_array($allergeneIds)) {
            $allergeneIds = [$allergeneIds];
        }

        $count = count($allergeneIds);
  
        if ($count > 0) {
            Allergene::whereIn('id', $allergeneIds)->forceDelete();
        
            return redirect()->route('admin.allergenes.index')
                ->with('success', 'Allergène(s) supprimé(s) avec succès.');
        }
    
        return redirect()->route('admin.allergenes.index')
            ->with('error', 'Aucun Allergène sélectionné.');
    }

    public function restoreMultiple(Request $request)
    {


        $allergeneIds = json_decode($request->input('selectedItems'));

        if (!is_array($allergeneIds)) {
            $allergeneIds = [$allergeneIds];
        }

        $count = count($allergeneIds);

        if ($count > 0) {
            Allergene::whereIn('id', $allergeneIds)->restore();
        
            return redirect()->route('admin.allergenes.index')
                ->with('success', 'Allergène(s) restauré(s) avec succès.');
        }

        return redirect()->back()->with('error', 'Aucun allergène sélectionné.');;
    }

}
