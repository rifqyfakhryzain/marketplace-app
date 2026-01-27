<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PublicProfileController extends Controller
{
    /**
     * Display public profile of a user
     */
    public function show(string $username): View
    {
        $user = User::where('username', $username)
            ->select([
                'id',
                'name',
                'username',
                'avatar',
                'bio',
                'created_at',
            ])
            ->firstOrFail();

        return view('profile.public', compact('user'));
        
    }
    
}
