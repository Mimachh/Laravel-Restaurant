<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fermeture;
use App\Models\Validation;

class FermetureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fermeture = Fermeture::first();
        $validation = Validation::first();

        $data = [
            'fermeture' => $fermeture,
            'validation' => $validation,
        ];
        return response()->json($data);
    }

}
