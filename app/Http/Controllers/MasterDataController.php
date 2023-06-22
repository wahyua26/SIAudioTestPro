<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    public function menu(){
        $user = DB::table('users')->get();
        $jabatan = DB::table('jabatans')->get();
        $ruangan = DB::table('workspaces')->get();
        return view('master.menu', ['user' => $user->count(), 'jabatan' => $jabatan->count(), 'ruangan' => $ruangan->count()]);
    }

    public function pegawai(){
        $pegawai = DB::table('users')->join('jabatans', 'users.jabatan_id', '=', 'jabatans.id')->join('workspaces', 'jabatans.workspace_id', '=', 'workspaces.id')->select('users.*', 'workspaces.nama', 'jabatans.jabatan')->get();
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

    public function tambahRuang(){
        return view('master.tambahruang');
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

    public function editRuang($id){
        //dd($id);
        $ruang = DB::table('workspaces')->where('id', '=', $id)->first();
        return view('master.editruang', ['ruang' => $ruang]);
    }

    public function kirimRuang(Request $request){
        //dd($request);
        $request->validate([
            'nama' => 'required|unique:workspaces,nama',
            'lokasi' => 'required',
            'bising' => 'required|integer|between:1,100',
        ]);

        Workspace::create([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'bising' => $request->bising,
        ]);

        return redirect()->route('ruang')->with('success', 'Ruang Kerja berhasil ditambah!');
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

    public function updateRuang(Request $request){
        //dd($request);
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'bising' => 'required|integer|between:1,100',
        ]);

        $ruang = Workspace::where([
            ['id','=',$request->id],
        ])->first();
        //dd($jabatan);

        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'bising' => $request->bising,
        ];

        $ruang->update($data);
        //dd($user);
        return redirect()->route('ruang')->with('success', 'Ruang Kerja berhasil diubah!');
    }

    public function hapusJabatan($id)
    {
        
        Jabatan::where([
            ['id','=',$id],
        ])->delete();

        return redirect()->route('jabatan')->with('success', 'Posisi Pegawai berhasil dihapus!');
    }

    public function hapusRuang($id)
    {
        Workspace::where([
            ['id','=',$id],
        ])->delete();

        return redirect()->route('ruang')->with('success', 'Ruang Kerja berhasil dihapus!');
    }
}
