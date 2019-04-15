<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LorionController extends Controller
{
    public function index()
    {
        return view('lorion/accueil');
    }
}
