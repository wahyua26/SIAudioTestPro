<?php

namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    public function index(){
        $rekomendasi = Rekomendasi::get();
        return view('rekomendasi.index', ['rekomendasi' => $rekomendasi]);
    }

    public function mintaRekomendasi(){
        $ruang = Workspace::get();
        return view('rekomendasi.form', ['ruang' => $ruang]);
    }
}
