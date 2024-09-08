<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialController extends Controller
{
    /**
     * Redirect the user to the OAuth provider.
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            
            // Check if the user already exists
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Log the user in
                Auth::login($user);

            } else {
                // Create a new user
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider_id' => $socialUser->getId(),
                    'provider' => $provider,
                    'password' => bcrypt('default-password'),
                ]);

                Auth::login($user);
            }

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login using ' . $provider);
        }
    }
}
