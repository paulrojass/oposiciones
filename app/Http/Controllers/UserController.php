<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;

use App\User;
use App\Category;

use Illuminate\Support\Str;

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
        $administradores = User::whereHas(
            "roles",
            function ($q) {
                $q->where("name", "administrator");
            }
        )->paginate(20);

        $usuarios = User::whereHas(
            "roles",
            function ($q) {
                    $q->where("name", "user");
            }
        )->paginate(20);

        $categorias = Category::all();
        return view('administradores', compact('administradores', 'usuarios', 'categorias'));
    }

    public function createAdministrator(Request $request)
    {
        $this->validator($request->all())->validate();

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        $password = substr(str_shuffle($permitted_chars), 0, 8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'remember_token' => Str::random(10),
            'password' => bcrypt($password)
        ]);

        // Le asignamos el rol de administrador
        $user->assignRole('administrator');
        if ($request->crear_usuarios) {
            $user->givePermissionTo('crear_usuarios');
        }

        Mail::to($user->email)->send(new NewAdministrator($user, $password));

        return back();
    }

    public function createUser(Request $request)
    {
        $this->validator($request->all())->validate();

        //$password = Str::random(8);
        $password = 'password';
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password)
        ]);
        $user->assignRole('user');

        foreach ($request->categories as $category) {
            DB::table('categories_users')->insert(
                [
                'user_id' => $user->id,
                'category_id' => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            );
        }

        Mail::to($user->email)->send(new NewAdministrator($user, $password));

        return back();
    }

    public function delete($id)
    {
        $user =  User::find($id);
        $user->delete();
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
