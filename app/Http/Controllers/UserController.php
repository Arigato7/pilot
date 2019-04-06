<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Role;
use Pilot\User;
use Pilot\Material;
use Pilot\UserInfo;
use Pilot\Position;
use Pilot\UserAction;
use Illuminate\Http\Request;
use Pilot\RegisterApplication;
use Pilot\EducationOrganization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Pilot\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Файл фото пользователя
     *
     * @var string
     */
    private $photo;

    public function __construct() {
        $this->middleware('auth');
    }

    protected function createDirectory($directory) {
        if (! Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
    }

    protected function deleteFile($path) {
        Storage::delete($path);
    }

    protected function getFileName($fileName) {
        return 'I_' . substr(md5(date('d_m_o_His')), 0, 16)
                . '.'
                . pathinfo($fileName, PATHINFO_EXTENSION);
    }

    /**
     * Список пользователей
     *
     * @return void
     */
    public function index() {
        return view('user.list', [
            'users' => User::all(),
            'applications' => RegisterApplication::all()->sortByDesc('created_at')
        ]);
    }
    /**
     * Страница пользователя
     *
     * @param int $login
     * @return void
     */
    public function show($login) {
        
        $user = User::where('login', $login)->first();

        $materials = DB::table('materials')
                        ->select('id', 'name', 'date')
                        ->where('user_id', $user->id)
                        ->take(5)
                        ->get();

        $news = DB::table('news')
                        ->select('id', 'header', 'date')
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
                        ->select('description', 'date')
                        ->where('user_id', $user->id)
                        ->take(5)
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
    /**
     * Форма редактирования данных пользователя
     *
     * @return void
     */
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
    /**
     * Обновление данных пользователя в БД
     *
     * @param Request $request
     * @return void
     */
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

        $this->createDirectory('/public/images');

        $imageName = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $imageName = $this->getFileName($fileName);

            if (Auth::user()->userInfo->photo != null) {
                $this->deleteFile('/public/images/' . Auth::user()->userInfo->photo);
            }

            Storage::putFileAs('public/images', $file, $imageName);
        }

        $this->photo = $request->photo != null ? $imageName : null;

        DB::table('user_infos')
                    ->where('user_id', Auth::user()->id)
                    ->update([
                        'email' => $request->email,
                        'position_id' => $request->position,
                        'phone' => $request->phone,
                        'name' => $request->name,
                        'lastname' => $request->lastname,
                        'middlename' => $request->middlename,
                        'photo' => $this->photo,
                        'education_organization_id' => $request->educationOrganization,
                        'about' => $request->about
                    ]);

        return redirect()
                    ->route(
                        'users.edit', [
                            'login' => Auth::user()->login
                        ]
                    );
    }
    /**
     * Undocumented function
     *
     * @param [type] $password
     * @return void
     */
    protected function checkPassword($secret, $password) {
        return bcrypt($password) == $secret;
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $user_id
     * @return void
     */
    public function updatePassword(Request $request, $user_id) {

    }
    /**
     * Удаление пользователя
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {

    }
    /**
     * Редактирование учетных данных пользователя (админ)
     *
     * @param int $id
     * @return void
     */
    public function editProps($id) {

        $userData = DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->join('user_infos', 'users.id', '=', 'user_infos.user_id')
                        ->join('positions', 'user_infos.position_id', '=', 'positions.id')
                        ->join('education_organizations', 'user_infos.education_organization_id', '=', 'education_organizations.id')
                        ->where('users.id', $id)
                        ->select('users.*',
                                'roles.id as role_id',
                                'roles.name as role_name',
                                'user_infos.name as user_name',
                                'user_infos.lastname as user_lastname',
                                'user_infos.middlename as user_middlename',
                                'user_infos.email as user_email',
                                'user_infos.phone as user_phone',
                                'user_infos.about as user_about',
                                'positions.id as position_id', 
                                'positions.name as position_name',
                                'education_organizations.id as organization_id',
                                'education_organizations.name as organization_name')
                        ->first();

        return view('user.edit', [
            'userData' => $userData,
            'roles' => Role::all()->sortByDesc('name'),
            'positions' => Position::all()->sortByDesc('name'),
            'organizations' => EducationOrganization::all()->sortByDesc('name'),
        ]);
    }
    /**
     * Сохранение учетных данных в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function saveProps(Request $request, $id) {
        $user = User::findOrFail($id);
        $info = UserInfo::where('user_id', $user->id)->first();

        $validator = Validator::make($request->all(), [
            'login' => 'required|max:255',
            'position' => 'required',
            'organization' => 'required',
            'role' => 'required',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('user/' . $user->id . '/props')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->login = $request->login;
        $user->role_id = $request->role;

        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }

        $info->education_organization_id = $request->organization;
        $info->position_id = $request->position;
        $info->email = $request->email != null ? $request->email : null;
        $info->phone = $request->phone != null ? $request->phone : null;
        $info->name = $request->name;
        $info->lastname = $request->lastname;
        $info->middlename = $request->middlename != null ? $request->middlename : null;
        $info->about = $request->about != null ? $request->about : null;

        $user->save();
        $info->save();

        return redirect('users');
    }
}