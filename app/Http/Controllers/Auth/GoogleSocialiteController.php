<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function handleCallback()
    {
        $user = Socialite::driver('google')->user();

        $checkUser = User::updateOrCreate(
            [
                'email' => $user->getEmail(),
            ],
            [
                'name' => $user->getName(),
                'provider_id' => $user->getId(),
            ]
        );

        Auth::login($checkUser, true);

        return redirect()->route('dashboard');
    }
}
