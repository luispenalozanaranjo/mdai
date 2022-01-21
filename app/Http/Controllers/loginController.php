<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller{
	use AuthenticatesUsers;

	public function mainView(){
		// GET - Página del login

		if( !Auth::check() ){
			// No está logueado
			return view('pages.login', ['title' => 'Login']);
		}

		// Tiene una sesión activa, redirect al dashboard
		return redirect()->intended('dashboard');
	}

	public function authenticate(Request $request){
		// POST - Intentamos hacer login
		$data = new \stdClass;
		$credentials = $request->only('usuario', 'password');
		$validacion = Validator::make($credentials, ['usuario' => 'required', 'password' => 'required']);

		if( !$validacion->fails() ){
			// La validacion de los campos pasó bien, intentamos el login

			if( Auth::attempt($credentials) ){
				// El login funcionó
				$data->msg = 'Credenciales correctas';
				$data->route = 'dashboard';
				$data->login = true;
			}
			else{
				// Hubo un problema al loguearse
				// Credenciales incorrectas
				$data->msg = 'Credenciales incorrectas';
				$data->login = false;
			}
		}
		else{
			// La validación de campos falló, falta un campo
			$data->msg = 'Completa todos los campos';
			$data->login = false;
		}
		
		// Devolvemos la data
		return response()->json($data);
	}

	public function getLogout(){
		// GET - Logout
		Auth::logout();
		return redirect()->intended('/');
	}

}