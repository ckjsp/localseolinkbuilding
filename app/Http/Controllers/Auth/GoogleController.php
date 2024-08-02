<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\lslbUser;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $existingUser = lslbUser::where('email', $googleUser->email)->first();

            if ($existingUser) {
                if ($existingUser->google_id) {
                    Auth::login($existingUser, true);
                    return redirect()->intended('home');
                } else {
                    Session::put('google_user', $googleUser);
                    return redirect()->route('link-google');
                }
            } else {
                $newUser = lslbUser::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(uniqid()),
                ]);

                Auth::login($newUser, true);
                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            return redirect('/login')->withErrors(['message' => 'Authentication failed']);
        }
    }
    /**
     * Link Google account to existing user.
     *
     * @return \Illuminate\Http\Response
     */
    public function linkGoogleAccount()
    {
        $googleUser = Session::get('google_user');
        if (!$googleUser) {
            return redirect('/login')->withErrors(['message' => 'No Google user found in session']);
        }

        $user = lslbUser::where('email', $googleUser->getEmail())->first();
        if ($user) {
            $user->update(['google_id' => $googleUser->getId()]);
            Auth::login($user, true);
            Session::forget('google_user');
            return redirect()->intended('home');
        }

        return redirect('/login')->withErrors(['message' => 'No matching user found']);
    }
}