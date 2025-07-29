<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                ->where('email', '=', $request->input('email'))
                ->firstOrFail();

            if(!Hash::check($request->input('password'), $user->password)) {
                throw new Exception('Wrong password');
            }

                session()->put('id', $user->id);
                session()->put('name', $user->name);
                session()->put('avatar', $user->avatar);
                session()->put('level', $user->level);

                return redirect()->route('courses.index');
        }
        catch(Throwable $e) {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $user = User::query()->create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'name' => $request->input('name'),
            'level' => 0,
        ]);

        UserRegisteredEvent::dispatch($user);
    }
}
