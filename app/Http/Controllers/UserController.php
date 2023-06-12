<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function tambahPegawai(){
        $jabatan = DB::table('jabatans')->get();
        return view('user.tambahpegawai',['jabatan' => $jabatan]);
    }

    public function store(Request $request){
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $ruang = DB::table('jabatans')->join('workspaces', 'workspaces.id', '=', 'jabatans.workspace_id')->where('jabatans.id', '=', $request->jabatan)->value('workspaces.id');
        //dd($ruang);

        User::create([
            'name' => $request->name,
            'status' => $request->status,
            'tglLahir' => $request->tglLahir,
            'jabatan_id' => $request->jabatan,
            'workspace_id' => $ruang,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil ditambah!');
    }

    public function editPegawai($id){
        $jabatan = DB::table('jabatans')->get();
        $user = DB::table('users')->where('id', '=', $id)->first();
        return view('user.editpegawai', ['user' => $user, 'jabatan' => $jabatan]);
    }
    
    public function updatePegawai(Request $request){
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $ruang = DB::table('jabatans')->join('workspaces', 'workspaces.id', '=', 'jabatans.workspace_id')->where('jabatans.id', '=', $request->jabatan)->value('workspaces.id');
        //dd($ruang);

        $user = User::where([
            ['id','=',$request->id],
        ])->first();
        //dd($user);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'tglLahir' => $request->tglLahir,
            'jabatan_id' => $request->jabatan,
            'workspace_id' => $ruang,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user->update($data);
        //dd($user);
        return redirect()->route('pegawai')->with('success', 'Karyawan berhasil diedit!');
    }

    public function hapusPegawai($id)
    {
        
        User::where([
            ['id','=',$id],
        ])->delete();

        return redirect()->route('pegawai')->with('success', 'Karyawan berhasil dihapus!');
    }

}
