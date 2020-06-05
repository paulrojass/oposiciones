<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\User;

//use Mail;

use App\Mail\NewAdministrator;

use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function myProfile()
    {
    	$user = auth()->user();

    	return view('client.panel-user-profile', compact('user'));
    }

    public function administrators()
    {
        $administradores = User::whereHas("roles", function($q){ $q->where("name", "administrator"); })->paginate(20);
    	$usuarios = User::whereHas("roles", function($q){ $q->where("name", "user"); })->paginate(20);
    	return view('administradores', compact('administradores', 'usuarios'));
    }

    public function createUser(Request $request)
    {
        $this->validator($request->all())->validate();


		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

		$password = substr(str_shuffle($permitted_chars), 0, 8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password)
        ]);

        // Le asignamos el rol de administrador
        $user->assignRole('administrator');
        if($request->crear_usuarios){
        	$user->givePermissionTo('crear_usuarios');
        }

		Mail::to($user->email)->send(new NewAdministrator($user, $password));

        return back();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

}
