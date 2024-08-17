<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
    
            $user = User::where('google_id', $googleUser->getId())->first();
    
            if ($user) {
                Auth::login($user);
            } else {
                $user = User::updateOrCreate(
                    ['email' => $googleUser->getEmail()],
                    [
                        'name' => $googleUser->getName(),
                        'google_id' => $googleUser->getId(),
                        'email_verified_at' => Carbon::now(),
                        'password' => Hash::make(uniqid()) // random password
                    ]
                );
                Auth::login($user);
            }
    
            return redirect()->route('home');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect('/')->with('error', 'Failed to log in with Google.');
        }
    }
    
    



}