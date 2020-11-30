<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller {

    public function index() {
        $users = User::all();

        return view('users', [
            'users' => $users
        ]);
    }

    public function create() {
        $user = new User();

        return view('user', [
            'user' => $user
        ]);
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ];

        $messages = [
            'name.required' => 'O campo nome deve ser preenchido',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'email.required' => 'O campo e-mail deve ser preenchido',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido',
            'email.unique' => 'Este e-mail já está cadastrado',
            'password.required' => 'O campo senha deve ser preenchido',
            'password.confirmed' => 'As senhas não conferem'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return redirect()->route('users.index');
    }

    public function edit($id) {
        $user = User::find($id);

        return view('user', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed',
        ];

        $messages = [
            'name.required' => 'O campo nome deve ser preenchido',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'email.required' => 'O campo e-mail deve ser preenchido',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido',
            'email.unique' => 'Este e-mail já está cadastrado',
            'password.confirmed' => 'As senhas não conferem'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }

}