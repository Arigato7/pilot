<?php

namespace Pilot\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Pilot\RegisterApplication;

class RegisterApplicationController extends Controller
{
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

    }
    /**
     * Удаление заявки на регистрацию из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        RegisterApplication::findOrFail($id)->delete();
        return redirect()->route('users');
    }
}
