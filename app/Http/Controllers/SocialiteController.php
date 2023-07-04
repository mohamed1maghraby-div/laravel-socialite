<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function login()
    {
        return Socialite::driver('github')->redirect();
    }
    
    public function redirect()
    {
        $socialieUser = Socialite::driver('github')->user();
        $user = User::create([
            'name' => $socialieUser->name,
            'email' => $socialieUser->getEmail(),
            'provider_id' => $socialieUser->getId(),
        ]);

        //auth user
        Auth::login($user, true);

        //redirect dashboard
        return to_route('dashboard');
    }
}
