<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        try {
            $user = User::query()
                ->where('email',$request->get('email'))
                ->where('password',$request->get('password'))
                ->firstOrFail();

            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('avatar', $user->avatar);
            session()->put('level', $user->level);

            return redirect()->route('courses.index');
        } catch (Throwable $e) {
            return redirect()->route('login');
        }

    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }
}
