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
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        User::create([
            'name' => $request->name,
            'status' => $request->status,
            'tglLahir' => $request->tglLahir,
            'jabatan_id' => $request->jabatan,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user = User::where([
            ['email','=',$request->email],
        ])->first();

        //dd($user);

        if($request->hasFile('foto'))
        {
            $filename = uniqid() . '.png';
            $request->foto->storeAs('images',$filename,'public');
            $data = ['foto' => $filename];
            $user->update($data);
        }
        else{
            $data = ['foto' => 'avatar5.png'];
            $user->update($data);
        }
        
        //dd($user);

        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil ditambah!');
    }

    public function editPegawai($id){
        $jabatan = DB::table('jabatans')->get();
        $user = DB::table('users')->where('id', '=', $id)->first();
        return view('user.editpegawai', ['user' => $user, 'jabatan' => $jabatan]);
    }

    public function editAkun($id){
        $jabatan = DB::table('jabatans')->get();
        $user = DB::table('users')->where('id', '=', $id)->first();
        return view('user.editakun', ['user' => $user, 'jabatan' => $jabatan]);
    }
    
    public function updatePegawai(Request $request){
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::where([
            ['id','=',$request->id],
        ])->first();
        //dd($user);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'tglLahir' => $request->tglLahir,
            'jabatan_id' => $request->jabatan,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user->update($data);

        //dd($user);

        if($request->hasFile('foto'))
        {
            $filename = uniqid() . '.png';
            $request->foto->storeAs('images',$filename,'public');
            $data = ['foto' => $filename];
            $user->update($data);
        }
        else{
            $data = ['foto' => 'avatar5.png'];
            $user->update($data);
        }
        //dd($user);
        return redirect()->route('pegawai')->with('success', 'Karyawan berhasil diubah!');
    }

    public function updateAkun(Request $request){
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::where([
            ['id','=',$request->id],
        ])->first();
        //dd($user);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'tglLahir' => $request->tglLahir,
            'jabatan_id' => $request->jabatan,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user->update($data);
        //dd($user);

        if($request->hasFile('foto'))
        {
            $filename = uniqid() . '.png';
            $request->foto->storeAs('images',$filename,'public');
            $data = ['foto' => $filename];
            $user->update($data);
        }
        else{
            $data = ['foto' => 'avatar5.png'];
            $user->update($data);
        }

        return redirect()->route('detail-akun', ['id' => $request->id ])->with('success', 'Detail akun berhasil diubah!');
    }

    public function hapusPegawai($id)
    {
        
        User::where([
            ['id','=',$id],
        ])->delete();

        return redirect()->route('pegawai')->with('success', 'Karyawan berhasil dihapus!');
    }

    public function detail($id){
        $user = DB::table('users')->join('jabatans', 'jabatans.id', '=', 'users.jabatan_id')->join('workspaces', 'workspaces.id', '=', 'jabatans.workspace_id')->select('users.*', 'jabatans.jabatan', 'workspaces.nama')->where('users.id', '=', $id)->first();
        //dd($user);
        return view('user.detail',['user' => $user]);
    }

    public function updateFoto (Request $request){
        //dd($request);
        $user = User::where([
            ['id','=',$request->id],
        ])->first();

        $filename = uniqid() . '.png';
        $request->foto->storeAs('images',$filename,'public');
        $data = ['foto' => $filename];
        $user->update($data);

        return redirect()->route('detail-akun', ['id' => $request->id ])->with('success', 'Foto profil berhasil diubah!');
    }
}
