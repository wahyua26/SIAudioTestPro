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

    public function detail($id){
        $detail = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->where('audiometris.id', $id)->first();
        //dd($detail);
        $kiri1 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 1)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri2 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 2)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri3 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 3)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri4 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 4)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri5 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 5)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');

        $kanan1 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 1)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan2 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 2)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan3 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 3)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan4 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 4)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan5 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->join('users', 'audiometris.user_id', '=', 'users.id')->where('users.id', $id)->where('detail_audiometris.deret_id', 5)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');

        return view('audiometri.detail', ['detail' => $detail, 'kiri1' => $kiri1, 'kiri2' => $kiri2, 'kiri3' => $kiri3, 'kiri4' => $kiri4, 'kiri5' => $kiri5, 'kanan1' => $kanan1, 'kanan2' => $kanan2, 'kanan3' => $kanan3, 'kanan4' => $kanan4, 'kanan5' => $kanan5]);
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
