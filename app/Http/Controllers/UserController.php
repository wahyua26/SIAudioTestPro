<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function tambahPegawai(){
        $jabatan = Jabatan::get();
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
        $jabatan = Jabatan::get();
        $user = User::where('id', '=', $id)->first();
        return view('user.editpegawai', ['user' => $user, 'jabatan' => $jabatan]);
    }

    public function editAkun($id){
        $jabatan = Jabatan::get();
        $user = User::where('id', '=', $id)->first();
        return view('user.editakun', ['user' => $user, 'jabatan' => $jabatan]);
    }
    
    public function updatePegawai(Request $request){
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
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



// <?php

// namespace App\Http\Controllers;

// use App\Http\Resources\UserResource;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Database\QueryException;
// use Illuminate\Http\Response;
// use App\Models\Pegawai;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;

// class UserController extends Controller
// {
//     public function index()
//     {
//         // try {
//         //     $users = DB::table('tb_pegawai')->select('tb_pegawai.*')->get();
//         //     return response()->json($users, Response::HTTP_OK);
//         // } catch (QueryException $e) {
//         //     $error = [
//         //         'error' => $e->getMessage()
//         //     ];
//         //     return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
//         // }
//         try {
//             $users = DB::table('users')->select('users.*')->get();
//             return response()->json($users, Response::HTTP_OK);
//         } catch (QueryException $e) {
//             $error = [
//                 'error' => $e->getMessage()
//             ];
//             return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
//         }
//     }

//     public function store(Request $request)
//     {
//         try {
//             $validator = validator::make($request->all(), [
//                 'name' => 'required',
//                 'email' => 'required',
//                 'password' => 'required'
//             ]);
//             if ($validator->fails()){
//                 return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
//             }
//             DB::insert('insert into users (name, email, password) values (?, ?, ?)', [$request->name, $request->email, bcrypt($request->password)]);
//             $response = [
//                 'Success' => 'New User Created',
//             ];
//             return response()->json($response, Response::HTTP_CREATED);
//         } catch (QueryException $e) {
//             $error = [
//                 'error' => $e->getMessage()
//             ];
//             return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
//         }
//     }

//     public function update(Request $request, $id)
//     {
//         try {
//             $validator = validator::make($request->all(), [
//                 'name' => 'required',
//                 'email' => 'required',
//                 'password' => 'required'
//             ]);
//             if ($validator->fails()){
//                 return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
//             }
//             $user = DB::table('users')->where('users.id','=',$id)->first();
//             if (!$user){
//                 return response()->json(['error' => 'User Not Found'], Response::HTTP_UNPROCESSABLE_ENTITY);
//             }
//             DB::table('users')->where('users.id','=',$id)->update(
//                 ['name' => $request->name, 
//                 'email' => $request->email, 
//                 'password' => bcrypt($request->password)
//             ]);
//             $response = [
//                 'Success' => 'User Updated',
//             ];
//             return response()->json($response, Response::HTTP_OK);
//         } catch (QueryException $e) {
//             $error = [
//                 'error' => $e->getMessage()
//             ];
//             return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
//         }
//     }

//     public function destroy($id)
//     {
//         try {
//             $user = DB::table('users')->where('users.id','=',$id)->first();
//             if (!$user){
//                 return response()->json(['error' => 'User Not Found'], Response::HTTP_UNPROCESSABLE_ENTITY);
//             }
//             DB::table('users')->where('users.id','=',$id)->delete();
//             return response()->json(['success' => 'User deleted successfully.']);
//         } catch (QueryException $e) {
//             $error = [
//                 'error' => $e->getMessage()
//             ];
//             return response()->json($error, Response::HTTP_FORBIDDEN);
//         }
//     }

// }