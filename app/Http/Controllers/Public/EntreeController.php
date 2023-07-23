<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Entree;
use Illuminate\Http\Request;

class EntreeController extends Controller
{
    public function index() {
      $entrees = Entree::where('status', 1)->get();  
      return response()->json($entrees);
    }
}
