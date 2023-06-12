<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    public function menu(){
        return view('master.menu');
    }

    public function pegawai(){
        $pegawai = DB::table('users')->join('workspaces', 'users.workspace_id', '=', 'workspaces.id')->join('jabatans', 'users.jabatan_id', '=', 'jabatans.id')->select('users.*', 'workspaces.nama', 'jabatans.jabatan')->get();
        //dd($pegawai);
        return view('master.pegawai', ['pegawai' => $pegawai]);
    }

    public function ruang(){
        $ruang = DB::table('workspaces')->get();
        return view('master.ruang', ['ruang' => $ruang]);
    }

    public function jabatan(){
        $jabatan = DB::table('jabatans')->join('workspaces', 'workspaces.id', '=', 'jabatans.workspace_id')->select('jabatans.*', 'workspaces.nama')->get();
        //dd($jabatan);
        return view('master.jabatan', ['jabatan' => $jabatan]);
    }

    public function tambahJabatan(){
        $ruang = DB::table('workspaces')->get();
        return view('master.tambahjabatan', ['ruang' => $ruang]);
    }

    public function kirimJabatan(Request $request){
        //dd($request);
        $request->validate([
            'jabatan' => 'required|unique:jabatans,jabatan',
            'divisi' => 'required',
            'ruangKerja' => 'required',
        ]);

        Jabatan::create([
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'workspace_id' => $request->ruangKerja,
        ]);

        return redirect()->route('jabatan')->with('success', 'Posisi Pegawai berhasil ditambah!');
    }

    public function editJabatan($id){
        $jabatan = DB::table('jabatans')->where('id', '=', $id)->first();
        $ruang = DB::table('workspaces')->get();
        return view('master.editjabatan', ['jabatan' => $jabatan, 'ruang' => $ruang]);
    }

    public function updateJabatan(Request $request){
        //dd($request);
        $request->validate([
            'jabatan' => 'required',
            'divisi' => 'required',
            'ruangKerja' => 'required',
        ]);

        $jabatan = Jabatan::where([
            ['id','=',$request->id],
        ])->first();
        //dd($jabatan);

        $data = [
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'workspace_id' => $request->ruangKerja,
        ];

        $jabatan->update($data);
        //dd($user);
        return redirect()->route('jabatan')->with('success', 'Posisi Pegawai berhasil diubah!');
    }

    public function hapusJabatan($id)
    {
        
        Jabatan::where([
            ['id','=',$id],
        ])->delete();

        return redirect()->route('jabatan')->with('success', 'Posisi Pegawai berhasil dihapus!');
    }
}
