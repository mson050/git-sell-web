<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerSubmit( Request $request)
    {
        $fullname = $request->input('fullname');
        $role = $request->input('role');
        $email = $request->input('username');
        $password = $request->input('password');

        $user = new User;

        $user->fullname = $fullname;
        $user->role = $role;
        $user->email = $email;
        $user->password = bcrypt($password);
        if(User::where('email', '=', $email)->count() > 0){
            return back()
            ->withError('Tai khoan da duoc su dung');  
        } else {
            $user->save();
            return redirect()->route('auth.login');
        }
    }

    public function login()
    {
        return view('auth.login');
    }
    public function loginSubmit(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $user = new User;
        if(Auth::attempt([
            'password'=> $password,
            'email' => $username
        ]))
        {
            if($user->role == 1){
                return redirect()
                ->route('items.index');
            } else {
                return redirect()->route('client.index');
            }
        } else {
            return back()
            ->withError('Sai thong tin dang nhap');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
