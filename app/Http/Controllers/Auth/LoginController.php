<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use Exception;
use App\User;
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
        $this->middleware('guest')->except('logout');
    }
	public function redirectToLinkedin() {
        return Socialite::driver('linkedin')->redirect();
    }
    public function handleLinkedinCallback() {
        try {
            $user = Socialite::driver('linkedin')->user();
            $finduser = User::where('linkedin_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'linkedin_id' => $user->id]);
                Auth::login($newUser);
                return redirect()->back();
            }
        }
        catch(Exception $e) {
            return redirect('auth/linkedin');
        }
    }
}
