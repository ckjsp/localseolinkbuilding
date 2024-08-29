<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\lslbUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // echo Hash::make('jspinfotech');exit;
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle(Request $request)
    {
        $request->validate([
            'selected_role' => 'required|in:2,3',
        ], [
            'selected_role.required' => 'Please select a role before signing in with Google.',
            'selected_role.in' => 'Invalid role selected.',
        ]);
        session(['selected_role' => $request->selected_role]);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
            //$googleUser = Socialite::driver('google')->user();
            $googleUser = Socialite::driver('google')->stateless()->user();
            $selectedRole = session('selected_role');
            $user = lslbUser::where('email', $googleUser->email)->first();

            if ($user) {
                $user->update([
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                ]);
            } else {
                $user = lslbUser::create([
                    'role_id' => $selectedRole,
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ]);
            }

            //Auth::login($user, true);

            //return redirect()->intended('home');

            if (Auth::login($user, true)) {
                return redirect()->intended('home');
            } else {
                return redirect('/login')->withErrors(['message' => 'Authentication failed']);
            }
        } catch (Exception $e) {
            // Handle the error
            return redirect('/login')->withErrors(['message' => 'Authentication failed']);
        }
    }
}
