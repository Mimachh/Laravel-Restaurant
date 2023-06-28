<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->roles;
        $checkRoles = [];
    
        foreach ($roles as $role) {
            $checkRoles[] = $role['id'];
        }
    
        if (in_array(1, $checkRoles, false)) {
            return redirect('/admin/dashboard');
        } else if (in_array(2, $checkRoles, false)) {
            return redirect('/admin/dashboard');
        } else if (in_array(3, $checkRoles, false)) {
            return redirect('/admin/dashboard');
        } else if (in_array(5, $checkRoles, false)) {
            return redirect('/');
        }

    }
}
