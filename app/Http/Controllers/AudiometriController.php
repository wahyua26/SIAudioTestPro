<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AudiometriController extends Controller
{
    public function index(){
        $hasil = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->get();
        //dd($hasil);
        $count = $hasil->count();
        //dd($cek);
        return view('audiometri.index', ['hasil' => $hasil, 'count' => $count]);
    }

    public function home(){
        $audiometri = DB::table('audiometris')->get();
        //dd($audiometri->count());
        return view('home', ['audiometri' => $audiometri->count()]);
    }
}
