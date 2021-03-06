<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        'regex:(@tup.edu.ph)'
        return Validator::make($data, [
            'firstname'=>['required','string','max:255'],
            'lastname'=>['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:(@tup.edu.ph)'],
            'contact_number'=>['required', 'string', 'min:8','max:11'],
            'checkbox'=>['accepted'],
            'password' => ['required', 'string', 'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()
                ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'name'=>$data['firstname']." ".$data['lastname'],
            'email' => $data['email'],
            'contact_number'=>$data['contact_number'],
            'password' => $data['password'],
        ]);
    }
}
