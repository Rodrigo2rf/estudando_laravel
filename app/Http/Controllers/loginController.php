<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class loginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function create()
    {
        return view('login.criar-conta');
    }

    public function store(Request $request)
    {
        // remove o token dos dados enviados
        $data = $request->except('_token');

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
    
        Auth::login($user);
    
        // Rota nomeada
        return redirect()->route('admin');
    
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autenticar(Request $request)
    {
        $credentials = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin');
        }

        return back()->withErrors([
            'email' => 'Senha e/ou usuários não encontrados.',
        ]);
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    } 
}
