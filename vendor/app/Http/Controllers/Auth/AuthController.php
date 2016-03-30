<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:pegawai', ['except' => 'logout']);
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        Auth::guard('pegawai')->logout();
        $request->session()->flush();
        return redirect('login');
    }

    /**
     * Tampilkan Form Login
     * @return Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     * @param  Request    $request
     * @return Response
     */
    public function login(Request $request)
    {
        #Validasi Server Side
        $remember = false;
        if ($request->get('remember')) {
            $remember = true;
        }
        $validasi = $this->validator($request->all());
        if ($validasi->fails()) {
            return redirect('/login')
                ->withErrors($validasi->errors())
                ->withInput();
        }

        #Check data login
        if (Auth::guard('pegawai')->attempt(['username' => $request->get('username'), 'password' => $request->get('password')], $remember)) {
            #redirect ke halaman muka bila sukses login
            switch (Auth::guard('pegawai')->user()->jabatan) {
                case 'Dokter':
                    return redirect()->intended('/dokter');
                    break;
                case 'Administrasi':
                    return redirect()->intended('/administrasi');
                    break;
                case 'Konsultan':
                    return redirect()->intended('/konsultan');
                    break;
                case 'Apoteker':
                    return redirect()->intended('/apoteker');
                    break;
                default:
                    abort('401');
                    break;
            }

        }
        #redirect ke halaman login bila gagal login dan store Pesan Error ke Session
        return redirect('login')
            ->with('response', ['status' => 'error', 'message' => 'Data login tidak valid']);

    }

    /**
     * Validasi data login.
     *
     * @param  array                                        $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            'username.required' => 'Username harus di isi.',
            'username.between' => 'Username harus diantara :min - :max karakter',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal :min karakter',
        ];

        return Validator::make($data, [
            'username' => 'required',
            'password' => 'required|min:6',
        ], $message);
    }



}
