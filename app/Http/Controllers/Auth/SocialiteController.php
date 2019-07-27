<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Socialite;

class SocialiteController extends Controller
{
    protected $supportedProviders = [
        'facebook',
        'twitter',
        'google',
    ];

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     *
     * @return redirect
     */
    public function redirectToProvider($provider)
    {
        if ( ! in_array($provider, $this->supportedProviders)) {
            return abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param         $provider
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback($provider, Request $request)
    {
        if ( ! count($request->all())) {
            return redirect('/');
        }

        try {
            $socialite = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            \Log::error($e->getMessage());

            return redirect()->route('auth.socialite', $provider);
        }

        # Check if email existing.
        if (empty($socialite->getEmail())) {
            return redirect('/')->with('error', 'لم نستطع الحصول على البريد الالكتروني الخاص بك.');
        }

        # Find the user in the database.
        if (auth()->check()) {
            $user = auth()->user();

            $exists = User::withTrashed()
                          ->where('id', '!=', $user->id)
                          ->where("providers->{$provider}->id", $socialite->getId())
                          ->first();

            if ($exists) {
                return redirect()
                    ->route('users.edit')
                    ->with('error', 'الحساب الذي ادخلته مرتبط مع حساب اخر.');
            }
        } else {
            $user = User::withTrashed()
                        ->where("providers->{$provider}->id", $socialite->getId())
                        ->orWhere('email', $socialite->getEmail())
                        ->first();
        }


        # Create new user if not existing.
        if ( ! $user) {
            $username = explode('@', $socialite->getEmail());
            if (User::withTrashed()->where('username', $username[0])->first()) {
                $username = $username[0] . '_' . substr($socialite->getId(), -4);
            } else {
                $username = $username[0];
            }

            $providers = [
                $provider => [
                    'id' => $socialite->getId(),
                    'token' => $socialite->token,
                    'secret' => optional($socialite)->tokenSecret
                ]
            ];

            $user = User::create([
                'providers' => $providers,
                'name' => $socialite->getName(),
                'email' => $socialite->getEmail(),
            ]);

            if ($user) {
                $user->profile()->save(new Profile([
                    'settings' => [
                        'comments' => true,
                        'notices' => false,
                        'newsletter' => true,
                        'push' => [
                            'follow' => true,
                            'diary-like' => true,
                            'comment' => true,
                            'comment-reply' => true,
                            'comment-mention' => true,
                            'diary-mention' => true,
                            'comment-like' => true,
                        ],
                    ]
                ]));
            }
        }

        # Update user data.
        $providers = $user->providers;
        $providers[$provider] = [
            'id' => $socialite->getId(),
            'token' => $socialite->token,
            'secret' => optional($socialite)->tokenSecret
        ];
        $user->providers = $providers;
        $user->save();

        # Login
        if ( ! auth()->check()) {
            auth()->login($user, true);
            $this->authenticated($request, $user);

            return redirect('/');
        }

        return redirect()
            ->route('users.edit')
            ->with('success', 'تم ربط حسابك بنجاح!');
    }

    /**
     * Remove user Provider.
     *
     * @param $provider
     *
     * @return Response
     */
    public function removeProvider($provider)
    {
        if ( ! auth()->check()) {
            abort(404);
        }

        $user = auth()->user();

        # Update user data.
        $providers = $user->providers;
        unset($providers[$provider]);

        $user->providers = $providers;
        $user->save();

        return back();
    }

    /**
     * ..
     *
     * @param Request $request
     * @param         $user
     *
     * @return bool|\Illuminate\Http\RedirectResponse [type] [description]
     */
    public function authenticated(Request $request, $user)
    {
        # TODO: make this shit in event and remove it form LoginController too.

        if ( ! auth()->check()) {
            return false;
        }

//        if ($user->status != User::STATUS_ACTIVE) {
//            auth()->logout();
//
//            return redirect()->back()
//                             ->with('error',
//                                 'يبدوا أن الحساب الذي تحاول الوصول إليه محظور، هل من خطأ؟ قم بمراسلتنا إذاً!');
//        }
    }
}
