<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    public function menu(){
        return view('master.menu');
    }

    public function pegawai(){
        $pegawai = DB::table('users')->join('workspaces', 'users.workspace_id', '=', 'workspaces.id')->select('users.*', 'workspaces.nama')->get();
        //dd($pegawai);
        return view('master.pegawai', ['pegawai' => $pegawai]);
    }

    public function ruang(){
        $ruang = DB::table('workspaces')->get();
        return view('master.ruang', ['ruang' => $ruang]);
    }

    
}
