<?php

namespace App\Http\Controllers;

use App\Models\OrganisasiKategori;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index()
    {
        $title = "Organisasi";
        $kategoriList = OrganisasiKategori::all();
        return view('frontend.pages.organisasi', compact('title', 'kategoriList'));
    }

    public function showAnggota(OrganisasiKategori $kategori)
    {
        $title = "Anggota";
        $kategori->load('anggota');
        return view('frontend.pages.anggota', compact('title','kategori'));
    }
}
