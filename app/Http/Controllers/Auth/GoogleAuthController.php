<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;



class GoogleAuthController extends Controller
{
public function redirect()
{
    return Socialite::driver('google')
        ->stateless()
        ->with([
            'prompt' => 'select_account consent',
        ])
        ->redirect();
}


public function callback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if ($user) {
        if (!$user->google_id) {
            $user->update([
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
            ]);
        }
    } else {
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(32)),
        ]);
    }

    Auth::login($user);

    return redirect()->route('home');
}



}