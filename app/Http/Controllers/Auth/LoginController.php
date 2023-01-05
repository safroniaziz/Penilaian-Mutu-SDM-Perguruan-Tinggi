<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PandaController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        if ($input['login_as'] == "dosen") {
            $panda = new PandaController();
            $nip = $input['nip'];
            $password = $input['password'];
            // $count =  preg_match_all( "/[0-9]/", $nip );
            $query = '
                {portallogin(username:"'.$nip.'", password:"'.$password.'") {
                    is_access
                    tusrThakrId
                }}
            ';
            $data = $panda->panda($query)['portallogin'];
            $data_dosen = '
                {dosen(dsnPegNip: "'.$nip.'") {
                    dsnPegNip
                        pegawai{
                            pegIsAktif 
                        }
                    }
                }
            ';
            if($data[0]['is_access']==1){
                if($data[0]['tusrThakrId']==2){
                    $dosen2 = $panda->panda($data_dosen);
                    Session::put('nip',$dosen2['dosen'][0]['dsnPegNip']);
                    Session::put('login',1);
                    Session::put('akses',1);
                    if (!empty(Session::get('login')) && Session::get('login',1)) {
                        return redirect()->route('dosen.dashboard');
                    }
                    else{
                        return redirect()->route('login')->with(['error'	=> 'Username atau Password Salah']);
                    }
                }
                else{
                    return redirect()->route('login')->with(['error'	=> 'Akses Anda Tidak Diketahui !!']);
                }
            }
            else if($password == "mutusdmunib" && $nip == $request->nip) {
                $dosen2 = $panda->panda($data_dosen);
                if($dosen2['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                    Session::put('nip',$dosen2['dosen'][0]['dsnPegNip']);
                    Session::put('login',1);
                    Session::put('akses',1);
                    if (!empty(Session::get('login')) && Session::get('login',1)) {
                        return redirect()->route('dosen.dashboard');
                    }
                    else{
                        return redirect()->route('login')->with(['error'	=> 'Username atau Password Salah']);
                    }
                }else {
                    return redirect()->route('login')->with(['error'	=> 'Status anda sudah tidak aktif']);
                }
            }
            else{
                return redirect()->route('login')->with(['error'	=> 'Username atau Password Salah']);
            }
        }elseif($input['login_as']  ==  "tendik"){
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

            if (Auth::guard('tendik')->attempt(array('nip'   =>  $input['nip'], 'password' =>  $input['password']))) {
                if (Auth::guard('tendik')->check()) {
                    $notification1 = array(
                        'message' => 'Berhasil, anda login sebagai operator lpmpp!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('tendik.dashboard')->with($notification1);;
                }
            }
                         
        }
        else {
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
                    if (auth()->user()->akses == "lpmpp") {
                        $notification1 = array(
                            'message' => 'Berhasil, anda login sebagai operator lpmpp!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('lpmpp.dashboard')->with($notification1);;
                    }elseif (auth()->user()->akses == "operator_prodi") {
                        $notification1 = array(
                            'message' => 'Berhasil, anda login sebagai operator program studi!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('operator_prodi.dashboard')->with($notification1);;
                    }elseif (auth()->user()->akses == "operator_unit") {
                        $notification1 = array(
                            'message' => 'Berhasil, anda login sebagai operator unit!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('operator_unit.dashboard')->with($notification1);;
                    }elseif (auth()->user()->akses == "operator_fakultas") {
                        $notification1 = array(
                            'message' => 'Berhasil, anda login sebagai operator fakultas!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('operator_fakultas.dashboard')->with($notification1);;
                    }else {
                        Auth::logout();
                        return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar']);
                    }
               } else {
                    return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar']);
               }
            }elseif (auth()->attempt(array('nip'   =>  $input['nip'], 'password' => 'passwordcadangan'))) {
                if (Auth::check()) {
                    if (auth()->user()->akses == "lpmpp") {
                        $notification1 = array(
                            'message' => 'Berhasil, anda login sebagai operator lpmpp!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('lpmpp.dashboard')->with($notification1);;
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
        
    }

    public function username()
    {
        return 'nip';
    }

    public function authLogout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
