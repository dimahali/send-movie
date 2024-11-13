<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }

        if (request()->filled('go')) {
            session()->put('url.intended', request('go'));
        }

        return Socialite::driver($provider)->redirect();
    }

    public function authenticate($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }

        $social_auth_account = Socialite::driver($provider)->user();

        $this->loginOrCreateUser($social_auth_account, $provider);

        return redirect()->intended('home');
    }

    private function loginOrCreateUser($social_auth_account, $provider)
    {
        $user = User::where('email', $social_auth_account->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'email' => $social_auth_account->getEmail(),
                'name' => $social_auth_account->getName(),
                'auth_provider_id' => $social_auth_account->getId(),
                'auth_provider' => $provider,
                'password' => bcrypt(Str::random(32)),  // Random password for social login users
                'email_verified_at' => now(),
            ]);
        } else {
            $user->update([
                'name' => $social_auth_account->getName(),
                'auth_provider_id' => $social_auth_account->getId(),
                'auth_provider' => $provider,
            ]);
        }

        Auth::login($user);
    }
}
