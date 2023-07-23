<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alcool;
use Illuminate\Http\Request;

class AlcoolController extends Controller
{
    public function index() {
        $alcools = Alcool::where('status', 1)->get();  
        return response()->json($alcools);
      }
}
