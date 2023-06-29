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
        // $this->authorize('viewAny', Entree::class);

        $entrees = Entree::with('allergenes')->get();

        $trashedEntrees = Entree::onlyTrashed()->get();

        return view('admin.entrees.index', compact('entrees', 'trashedEntrees'));
    }
}
