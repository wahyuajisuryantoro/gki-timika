<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index (){
        $title = "Tentang Kami";
        return view('frontend.pages.tentangkami', compact('title'));
    }
}
