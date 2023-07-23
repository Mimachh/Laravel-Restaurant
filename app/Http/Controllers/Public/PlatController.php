<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Plat;
use Illuminate\Http\Request;

class PlatController extends Controller
{
    public function index() {
        $plats = Plat::where('status', 1)->get();  
        return response()->json($plats);
      }
}
