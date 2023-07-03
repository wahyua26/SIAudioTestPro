<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Models\Audiometri;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AudiometriController extends Controller
{
    public function index(){
        $hasil = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->get();
        return view('audiometri.index', ['hasil' => $hasil]);
    }

    public function detail($id){
        $detail = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->where('audiometris.id', $id)->first();
        //dd($detail);
        $kiri1 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 1)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri2 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 2)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri3 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 3)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri4 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 4)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri5 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 5)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');

        $kanan1 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 1)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan2 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 2)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan3 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 3)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan4 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 4)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan5 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 5)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');

        return view('audiometri.detail', ['detail' => $detail, 'kiri1' => $kiri1, 'kiri2' => $kiri2, 'kiri3' => $kiri3, 'kiri4' => $kiri4, 'kiri5' => $kiri5, 'kanan1' => $kanan1, 'kanan2' => $kanan2, 'kanan3' => $kanan3, 'kanan4' => $kanan4, 'kanan5' => $kanan5]);
    }

    public function cetakDetail($id){
        $detail = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->where('audiometris.id', $id)->first();
        //dd($detail);
        $kiri1 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 1)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri2 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 2)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri3 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 3)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri4 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 4)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');
        $kiri5 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 5)->where('detail_audiometris.posisiTelinga', 'kiri')->avg('detail_audiometris.nilai');

        $kanan1 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 1)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan2 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 2)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan3 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 3)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan4 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 4)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');
        $kanan5 = DB::table('detail_audiometris')->join('audiometris', 'detail_audiometris.audiometri_id', '=', 'audiometris.id')->where('audiometris.id', $id)->where('detail_audiometris.deret_id', 5)->where('detail_audiometris.posisiTelinga', 'kanan')->avg('detail_audiometris.nilai');

        $pdf = PDF::loadview('audiometri.detail_pdf',['detail' => $detail, 'kiri1' => $kiri1, 'kiri2' => $kiri2, 'kiri3' => $kiri3, 'kiri4' => $kiri4, 'kiri5' => $kiri5, 'kanan1' => $kanan1, 'kanan2' => $kanan2, 'kanan3' => $kanan3, 'kanan4' => $kanan4, 'kanan5' => $kanan5])->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function indexPegawai($id){
        $hasil = DB::table('audiometris')->join('users', 'audiometris.user_id', '=', 'users.id')->select('audiometris.*', 'users.name')->where('users.id', $id)->get();
        return view('audiometri.indexPegawai', ['hasil' => $hasil]);
    }

    public function home(){

        $audiometri = Audiometri::get();
        $rekomendasi = Rekomendasi::get();
        
        $from1 = date('2023-01-01');
        $to1 = date('2023-01-31');
        $januari = Audiometri::whereBetween('tanggal', [$from1, $to1])->avg('hasil');
        //dd($januari);
        $from2 = date('2023-02-01');
        $to2 = date('2023-02-29');
        $februari = Audiometri::whereBetween('tanggal', [$from2, $to2])->avg('hasil');
        $from3 = date('2023-03-01');
        $to3 = date('2023-03-31');
        $maret = Audiometri::whereBetween('tanggal', [$from3, $to3])->avg('hasil');
        $from4 = date('2023-04-01');
        $to4 = date('2023-04-30');
        $april = Audiometri::whereBetween('tanggal', [$from4, $to4])->avg('hasil');
        $from5 = date('2023-05-01');
        $to5 = date('2023-05-31');
        $mei = Audiometri::whereBetween('tanggal', [$from5, $to5])->avg('hasil');
        $from6 = date('2023-06-01');
        $to6 = date('2023-06-30');
        $juni = Audiometri::whereBetween('tanggal', [$from6, $to6])->avg('hasil');
        //dd($audiometri->count());
        $rekap = DB::table('rekomendasis')->join('workspaces', 'workspaces.id', '=', 'rekomendasis.workspace_id')->get();
        //dd($rekap);
        return view('home', [ 'rekap' => $rekap, 'audiometri' => $audiometri->count(), 'rekomendasi' => $rekomendasi->count(), 'januari' => $januari, 'februari' => $februari, 'maret' => $maret, 'april' => $april, 'mei' => $mei, 'juni' => $juni ]);
    }

    public function homePegawai($id){
        $from1 = date('2023-01-01');
        $to1 = date('2023-01-31');
        $januari = Audiometri::where('audiometris.user_id', $id)->whereBetween('tanggal', [$from1, $to1])->avg('hasil');
        //dd($januari);
        $from2 = date('2023-02-01');
        $to2 = date('2023-02-29');
        $februari = Audiometri::where('audiometris.user_id', $id)->whereBetween('tanggal', [$from2, $to2])->avg('hasil');
        $from3 = date('2023-03-01');
        $to3 = date('2023-03-31');
        $maret = Audiometri::where('audiometris.user_id', $id)->whereBetween('tanggal', [$from3, $to3])->avg('hasil');
        $from4 = date('2023-04-01');
        $to4 = date('2023-04-30');
        $april = Audiometri::where('audiometris.user_id', $id)->whereBetween('tanggal', [$from4, $to4])->avg('hasil');
        $from5 = date('2023-05-01');
        $to5 = date('2023-05-31');
        $mei = Audiometri::where('audiometris.user_id', $id)->whereBetween('tanggal', [$from5, $to5])->avg('hasil');
        $from6 = date('2023-06-01');
        $to6 = date('2023-06-30');
        $juni = Audiometri::where('audiometris.user_id', $id)->whereBetween('tanggal', [$from6, $to6])->avg('hasil');

        $audiometri = Audiometri::with('user')->where('audiometris.user_id', $id)->get();
        //dd($audiometri->count());
        return view('homePegawai', ['audiometri' => $audiometri->count(), 'januari' => $januari, 'februari' => $februari, 'maret' => $maret, 'april' => $april, 'mei' => $mei, 'juni' => $juni]);
    }
}
