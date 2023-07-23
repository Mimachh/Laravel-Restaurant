<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vin;
use Illuminate\Http\Request;

class VinController extends Controller
{
    public function index() {
        $vins = Vin::where('status', 1)->get();  
        return response()->json($vins);
      }
}
