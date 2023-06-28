<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    public function index(){
        $rekomendasi = DB::table('rekomendasis')->get();
        return view('rekomendasi.index', ['rekomendasi' => $rekomendasi]);
    }
}
