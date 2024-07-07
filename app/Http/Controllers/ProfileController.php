<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
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

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile');
    }

    public function deleteUser(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required'],
        ]);

        if (!Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'password' => __('Incorrect password.'),
            ]);
        }

        $user = $request->user();

        Auth::logout();

        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
