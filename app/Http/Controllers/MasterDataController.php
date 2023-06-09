<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    public function pegawai(){
        $pegawai = DB::table('users')->get();
        return view('master.pegawai', ['pegawai' => $pegawai]);
    }
}
