<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fermeture;
class FermetureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fermeture = Fermeture::first();

        return response()->json($fermeture);
    }

}
