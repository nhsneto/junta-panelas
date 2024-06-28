<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('profile.index');
    }

    public function updateEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'current_email' => ['required', 'email'],
            'new_email' => ['required', 'string', 'max:255', 'email', 'confirmed', 'unique:' . User::class . ',email'],
        ]);

        $user = $request->user();

        if (Str::lower($request->current_email) !== $user->email) {
            throw ValidationException::withMessages([
                'current_email' => __('The email is incorrect.'),
            ]);
        }

        $user->update([
            'email' => Str::lower($request->new_email),
        ]);

        return redirect()->route('profile');
    }
}
