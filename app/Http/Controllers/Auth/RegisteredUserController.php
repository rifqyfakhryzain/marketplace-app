<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $existingUser = User::where('email', $request->email)->first();

    if ($existingUser) {
        if ($existingUser->google_id) {
            throw ValidationException::withMessages([
                'email' => 'Email ini sudah terdaftar melalui Google. Silakan login menggunakan Google.',
            ]);
        }

        throw ValidationException::withMessages([
            'email' => 'Email ini sudah terdaftar. Silakan login.',
        ]);
    }

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'email_verified_at' => now(),
    ]);

    // ROLE DEFAULT
    $user->assignRole('buyer');

    // LOGIN LANGSUNG
    Auth::login($user);

    return redirect()->route('home');
}

}
