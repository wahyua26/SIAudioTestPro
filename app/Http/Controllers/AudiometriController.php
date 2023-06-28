<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AudiometriController extends Controller
{
    public function index(){
        $hasil = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->get();
        return view('audiometri.index', ['hasil' => $hasil]);
    }

    public function indexPegawai($id){
        $hasil = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->where('users.id', $id)->get();
        return view('audiometri.indexPegawai', ['hasil' => $hasil]);
    }

    public function home(){
        $audiometri = DB::table('audiometris')->get();
        $rekomendasi = DB::table('rekomendasis')->get();
        //dd($audiometri->count());
        return view('home', ['audiometri' => $audiometri->count(), 'rekomendasi' => $rekomendasi->count()]);
    }

    public function homePegawai($id){
        $audiometri = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->get();
        //dd($audiometri->count());
        return view('homePegawai', ['audiometri' => $audiometri->count()]);
    }
}
