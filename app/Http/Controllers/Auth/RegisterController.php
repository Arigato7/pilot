<?php

namespace Pilot\Http\Controllers\Auth;

use Pilot\User;
use Pilot\UserInfo;
use Pilot\Events\UserCreated;
use Pilot\Http\Controllers\Controller;
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
    protected $redirectTo = '/materials';

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
        // Проверяет на правильность данные пользователя
        return Validator::make($data, [
            'login' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Pilot\User
     */
    protected function create(array $data)
    {
        // Создает запись в таблице users 
        $user = User::create([
            'login' => $data['login'],
            'password' => bcrypt($data['password']),
        ]);
        // Создает запись в таблице user_infos
        UserInfo::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'lastname' => $data['lastname'],
        ]);

        event(new UserCreated($user));
        
        return $user;
    }
}
