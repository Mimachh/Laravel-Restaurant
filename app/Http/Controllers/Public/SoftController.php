<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Soft;
use Illuminate\Http\Request;

class SoftController extends Controller
{
    public function index() {
        $softs = Soft::where('status', 1)->get();  
        return response()->json($softs);
      }
}
