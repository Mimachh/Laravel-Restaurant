<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Dessert;
use Illuminate\Http\Request;

class DessertController extends Controller
{
    public function index() {
        $desserts = Dessert::where('status', 1)->get();  
        return response()->json($desserts);
      }
}
