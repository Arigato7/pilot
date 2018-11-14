<?php

namespace Pilot\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Pilot\RegisterApplication;

class RegisterApplicationController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255'
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
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function accept($id) {

    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id) {
        RegisterApplication::findOrFail($id)->delete();
        return redirect()->route('users');
    }
}
