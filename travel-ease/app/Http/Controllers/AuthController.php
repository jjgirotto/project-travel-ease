<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showFormLogin(){
        return view('login');
    }

    public function login(Request $request){
        $credenciais = $request->only('email', 'password');
    
        if (Auth::attempt($credenciais)){ 
            $request->session()->regenerate(); 
            
            $user = Auth::user();
            if($user->role == "ADM")
			    return redirect()->intended('/home-adm');
            else
			    return redirect()->intended('/home-cli');
        }

        return back() ->withErrors([
            'login' => 'Credenciais inválidas' 
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
