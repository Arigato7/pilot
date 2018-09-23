<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\User;
use Pilot\Material;
use Pilot\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Pilot\Http\Controllers\Controller;

class UserController extends Controller
{
    private $photo;
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        if (Gate::denies('administrate', Auth::user())) {
            abort(403, 'Вы не имеете право на просмотр данной страницы');
        }
        $users = User::all();
        return view('user.list', [
            'users' => $users
        ]);
    }
    public function show($login) {

        $user = User::where('login', $login)->first();

        $materials = DB::table('materials')
                        ->select('id', 'name', 'date')
                        ->where('user_id', $user->id)
                        ->take(5)
                        ->get();

        $news = DB::table('news')
                        ->select('id', 'header', 'theme', 'date')
                        ->where('user_id', $user->id)
                        ->take(5)
                        ->get();

        $organizations = DB::table('education_organizations')
                        ->select('id', 'name')
                        ->take(5)
                        ->get();

        $specialties = DB::table('specialties')
                        ->select('id', 'name')
                        ->take(5)
                        ->get();

        $subjects = DB::table('subjects')
                        ->select('id', 'name')
                        ->take(5)
                        ->get();

        $userActions = DB::table('user_actions')
                        ->select('description')
                        ->where('user_id', $user->id)
                        ->get();

        return view('user.show', [
            'user' => $user,
            'materials' => $materials,
            'news' => $news,
            'organizations' => $organizations,
            'specialties' => $specialties,
            'subjects' => $subjects,
            'actions' => $userActions
        ]);
    }
    public function edit() {
        $educationOrganizations = DB::table('education_organizations')
                                        ->select('id', 'name')
                                        ->get();
        $positions = DB::table('positions')
                            ->select('id', 'name')
                            ->get();

        $materials = Material::onlyTrashed()->where('who_deleted', Auth::user()->login)->get();
                            
        return view('user.settings', [
            'educationOrganizations' => $educationOrganizations,
            'positions' => $positions,
            'materials' => $materials
        ]);
    }
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'position' => 'required',
            'phone' => 'required|max:20',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'middlename' => 'nullable|max:255',
            'photo' => 'nullable|image'
        ]);
        if ($validator->fails()) {
            return redirect('user/' . Auth::user()->login . '/settings')
                        ->withErrors($validator)
                        ->withInput();
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            if (Auth::user()->userInfo->photo != null) {
                Storage::delete('/public/userdata/' . Auth::user()->userInfo->photo);
            }
            $this->photo = $file->store('/public/userdata/' . Auth::user()->login);
        }
        DB::table('user_infos')
                    ->where('user_id', Auth::user()->id)
                    ->update([
                        'email' => $request->email,
                        'position_id' => $request->position,
                        'phone' => $request->phone,
                        'name' => $request->name,
                        'lastname' => $request->lastname,
                        'middlename' => $request->middlename,
                        'photo' => explode('/', $this->photo)[3],
                        'education_organization_id' => $request->educationOrganization,
                        'about' => $request->about
                    ]);
        return redirect('user/' . Auth::user()->login . '/settings');
    }
}
