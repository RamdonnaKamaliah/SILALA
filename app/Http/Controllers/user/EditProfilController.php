<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditProfilController extends Controller
{
    public function index()
    {
        return view('user.editprofil' , ['title' => 'EDIT PROFIL ']);
    }
}