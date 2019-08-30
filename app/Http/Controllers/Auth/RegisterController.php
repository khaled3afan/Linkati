<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Models\Profile;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Rules\Username;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:60'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:profiles', new Username],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
//            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'referred_by' => Helper::referredBy(),
            'settings' => [
                'email' => [
                    'newsletter' => true
                ]
            ]
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed                    $user
     *
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $profile = $user->profiles()->save(new Profile([
            'name' => $request->name,
            'username' => $request->username,
            'theme_id' => 1,
        ]));

        return redirect()
            ->route('dashboard.profiles.show', $profile)
            ->with('status',
                'تم التسجيل بنجاح، قم بتفعيل حسابك عبر الرسالة التي أرسلناها لبريدك الإلكتروني كي تستطيع استخدام جميع ميزات منصة لينكاتي!');
    }
}
