<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => ['required', 'string', 'min:2', 'not_regex:/^[0-9]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'senha' => ['required', 'confirmed', Password::min(6)],
        ]);

        User::create([
            'nome' => Str::title($request->nome),
            'email' => Str::lower($request->email),
            'senha' => Hash::make($request->senha),
        ]);

        return redirect()->route('painel');
    }
}
