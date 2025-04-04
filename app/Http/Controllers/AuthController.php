<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function loginDoctor(){
        return  view("auth.loginDoctor");

    }
    public function loginPaciente(){
        return  view("auth.loginPaciente");

    }
}
