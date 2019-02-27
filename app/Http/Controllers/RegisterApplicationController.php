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
     * Undocumented function
     *
     * @return void
     */
    protected function sendLoginData() {
        
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
    public function accept(Request $request, $id) {
        $application = RegisterApplication::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('users')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User;

        $user->role_id = 3;
        $user->login = $application->login;
        $user->password = bcrypt($request->password);

        $user->save();
        
        $info = new UserInfo;

        $info->user_id = $user->id;
        $info->name = $application->name;
        $info->lastname = $application->lastname;
        $info->email = $application->email;
        $info->phone = $application->phone;

        $info->save();

        event(new UserCreated($user, $request->password));
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
        $this->deleteApplication($id);
        return redirect()->route('users');
    }
}
