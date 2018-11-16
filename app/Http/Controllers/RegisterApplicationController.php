<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\User;
use Pilot\UserInfo;
use Illuminate\Http\Request;
use Pilot\Events\UserCreated;
use Pilot\RegisterApplication;

class RegisterApplicationController extends Controller
{
    /**
     * Генерирует случайный пароль
     *
     * @param int $length
     * @return void
     */
    protected function getRandomPassword($length) {
        $symbols = [
            'a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0','.',',',
            '(',')','[',']','!','?',
            '&','^','%','@','*','$',
            '<','>','/','|','+','-',
            '{','}','`','~'
        ];
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, count($symbols) - 1);
            $password .= $symbols[$index];
        }
        return $password;
    }
    /**
     * Запись данных заявки на регистрацию в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|alpha_dash|max:255|unique:users,login',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'nullable|email'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $application = new RegisterApplication;

        $application->name = $request->name;
        $application->lastname = $request->lastname;
        $application->login = $request->login;
        $application->email = $request->email;
        $application->phone = $request->phone;

        $application->save();

        return redirect()->route('login');
    }
    /**
     * Одобрение заявки на регистрацию
     *
     * @param int $id
     * @return void
     */
    public function accept($id) {
        $application = RegisterApplication::findOrFail($id);

        $user = new User;

        $user->role_id = 3;
        $user->login = $application->login;
        $user->password = bcrypt('lab');

        $user->save();
        
        $info = new UserInfo;

        $info->user_id = $user->id;
        $info->name = $application->name;
        $info->lastname = $application->lastname;
        $info->about = $this->getRandomPassword(11);
        $info->email = $application->email;
        $info->phone = $application->phone;

        $info->save();

        event(new UserCreated($user));
        $this->deleteApplication($application->id);
        return redirect()->route('users');
    }
    /**
     * Удаление данных заявки из БД
     *
     * @param int $id
     * @return void
     */
    protected function deleteApplication($id) {
        RegisterApplication::findOrFail($id)->delete();
    }
    /**
     * Удаление заявки на регистрацию из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        $this->delete($id);
        return redirect()->route('users');
    }
}
