<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\lslbUser;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Find or create a user in your database
        $existingUser = lslbUser::where('google_id', $googleUser->id)->first();

        if ($existingUser) {
            // Log in the existing user
            Auth::login($existingUser);
        } else {
            // Create a new user
            $newUser = lslbUser::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(uniqid()), // Generate a random password
            ]);

            Auth::login($newUser);
        }

        return redirect()->to('/home'); // Redirect to a desired location
    }
}
