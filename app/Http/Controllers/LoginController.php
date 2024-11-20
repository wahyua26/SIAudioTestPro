<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //dd($request);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::where('users.email', $request->email)->first();
            //dd($request->email, $user->status);
            if($user->status == 'admin'){
                return redirect()->intended('/home')->with('success','Anda Berhasil Masuk!');
            }
            else{
                return redirect()->intended('/homePegawai/'.$user->id)->with('success','Anda Berhasil Masuk!');
            }
        }
        return back()->with('fail', 'Email atau Password anda Salah!');   

        // $http = new Client();
        // $api = 'http://127.0.0.1:8000/api/login';
        // $response = $http->post($api, [
        //     'headers' => [
        //         'Content-Type' => 'application/x-www-form-urlencoded',
        //     ],
        //     'form_params' => [
        //         'email' => $request->email,
        //         'password' => $request->password
        //     ],
        //     'http_errors' => false
        // ]);
        // $api_result = json_decode((string)$response->getBody(), true);
        // //dd($api_result);

        // if($api_result['message']=='Login success'){
        //     $user = User::where('users.email', $request->email)->first();
        //     //dd($request->email, $user->status);
        //     if($user->status == 'admin'){
        //         return redirect()->intended('/home')->with('success','Anda Berhasil Masuk!');
        //     }
        //     else{
        //         return redirect()->intended('/homePegawai/'.$user->id)->with('success','Anda Berhasil Masuk!');
        //     }
        // }
        
        // return back()->with('fail', 'Email atau Password anda Salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success', 'Anda Berhasil Keluar!');
    }

}
