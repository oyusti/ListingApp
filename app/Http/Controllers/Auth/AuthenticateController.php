<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticateController extends Controller
{
    public function create(){
        return inertia::render('Auth/Login');
    }

    public function store(Request $request){
        
    }
}
