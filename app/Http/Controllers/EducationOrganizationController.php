<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Position;
use Illuminate\Http\Request;
use Pilot\EducationOrganization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EducationOrganizationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    protected function createDirectory($directory) {
        if (! Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
    }

    protected function deleteFile($path) {
        return Storage::disk('local')->delete($path);
    }
    /**
     * Список образовательных организаций
     *
     * @return void
     */
    public function list() {

        $organizations = EducationOrganization::all();
        $positions = Position::all();

        return view('organizations.list', [
            'organizations' => $organizations,
            'positions' => $positions
        ]);
    }
    /**
     * Форма создания образовательной организации
     *
     * @return void
     */
    public function create() {
        return view('organizations.create');
    }
    /**
     * Страница с образовательной организацией
     *
     * @param int $id
     * @return void
     */
    public function show($id) {

        $organization = EducationOrganization::findOrFail($id);

        $users = DB::table('users')
                        ->join('user_infos', 'users.id', '=', 'user_infos.user_id')
                        ->join('positions', 'positions.id', '=', 'user_infos.position_id')
                        ->select('users.login', 'user_infos.name', 'positions.name as position')
                        ->where('user_infos.education_organization_id', $organization->id)
                        ->get();

        return view('organizations.show', [
            'organization' => $organization,
            'users' => $users
        ]);
    }
    /**
     * Форма редактирования данных организации
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {
        $organization = EducationOrganization::findOrFail($id);
        return view('organizations.edit', [
            'organization' => $organization
        ]);
    }
    /**
     * Обновление данных организации в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

        $organization = EducationOrganization::findOrFail($id);

        if (Gate::denies('update-organization', $organization)) {
            abort(403, 'У вас нет прав на изменение данных образовательной организации.');
        }

        $validator = Validator::make($request->all(), [
            'shortname' => 'max:255|nullable',
            'name' => 'required|max:255',
            'cite' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:12',
            'address' => 'required|max:255',
            'photo' => 'file|image|nullable'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('organizations.edit', ['id' => $organization->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $organization->shortname = $request->shortname != null ? $request->shortname : null;
        $organization->name = $request->name;
        $organization->cite = $request->cite;
        $organization->email = $request->email;
        $organization->phone = $request->phone;
        $organization->address = $request->address;
        $organization->description = $request->description != null ? $request->description : null;

        $path = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            if ($organization->photo != null) {
                $this->deleteFile('/public/organization/' . $organization->photo);
            }
            $path = $file->store('/public/organization/');
        }
        $organization->photo = $request->photo != null ? explode('/', $path)[3] : null;

        $organization->save();

        return redirect()->route('organizations.show', ['id' => $organization->id]);
    }
    /**
     * Запись данных организации в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'shortname' => 'max:255|nullable',
            'name' => 'required|max:255',
            'cite' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:12',
            'address' => 'required|max:255',
            'photo' => 'file|image|nullable'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('organizations.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $organization = new EducationOrganization;

        $organization->shortname = $request->shortname != null ? $request->shortname : null;
        $organization->name = $request->name;
        $organization->cite = $request->cite;
        $organization->email = $request->email;
        $organization->phone = $request->phone;
        $organization->address = $request->address;
        $organization->description = $request->description != null ? $request->description : null;

        $this->createDirectory("/public/organization");
        $path = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $path = $file->store('/public/organization/');
            $organization->photo = $request->photo != null ? explode('/', $path)[3] : null;
        }

        $organization->photo = $request->photo != null ? explode('/', $path)[3] : null;

        $organization->save();

        return redirect()->route('organizations');
    }
    /**
     * Удаление организации из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        $organization = EducationOrganization::findOrFail($id);
        if (Gate::denies('delete-organization', Auth::user(), $organization)) {
            return redirect()->route('organizations');
        }

        if ($organization->photo != null) {
            $this->deleteFile('/public/organization/' . $organization->photo);
        }

        $organization->delete();
        return redirect()->route('organizations');
    }
}
