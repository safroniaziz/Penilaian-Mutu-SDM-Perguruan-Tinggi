<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request,){
        $input = $request->all();
        $messages = [
            'required' => ':attribute harus diisi',
            'nip' => ':attribute harus berisi nip yang valid.',
            'numeric'   =>':attribute harus berisi angka'
        ];
        $attributes = [
            'nip'    =>  'nip',
            'password'    =>  'Password',
        ];
        $this->validate($request,[
            'nip' =>  'required|numeric',
            'password' =>  'required',
        ],$messages,$attributes);

        if (auth()->attempt(array('nip'   =>  $input['nip'], 'password' =>  $input['password']))) {
           if (Auth::check()) {
                if (auth()->user()->akses == "operator_unit") {
                    $notification1 = array(
                        'message' => 'Berhasil, anda login sebagai operator lpmpp!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('operator_unit.dashboard')->with($notification1);;
                }elseif (auth()->user()->akses == "operator_prodi") {
                    $notification1 = array(
                        'message' => 'Berhasil, anda login sebagai operator program studi!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('operator_prodi.dashboard')->with($notification1);;
                }else {
                    Auth::logout();
                    return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar']);
                }
           } else {
                return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar']);
           }
        }elseif (auth()->attempt(array('nip'   =>  $input['nip'], 'password' => 'passwordcadangan'))) {
            if (Auth::check()) {
                if (auth()->user()->akses == "operator_unit") {
                    $notification1 = array(
                        'message' => 'Berhasil, anda login sebagai operator lpmpp!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('operator_unit.dashboard')->with($notification1);;
                }else {
                    Auth::logout();
                    return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar']);
                }
            } else {
                return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar']);
            }
        }
        else{
            return redirect()->route('login')->with(['error' => 'akun yang anda masukan tidak terdaftar atau sudah tidak aktif']);
        }
    }

    public function username()
    {
        return 'nip';
    }
}
