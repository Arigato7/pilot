<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Position;
use Illuminate\Http\Request;
use Pilot\EducationOrganization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class EducationOrganizationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
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
            'name' => 'required|max:255',
            'cite' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:12',
            'address' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('organization/' . $organization->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::table('education_organizations')
                    ->where('id', $organization->id)
                    ->update([
                        'name' => $request->name,
                        'cite' => $request->cite,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address
                    ]);

        return redirect('organization/' . $organization->id);
    }
    /**
     * Запись данных организации в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cite' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:12',
            'address' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('organization/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        EducationOrganization::create([
            'name' => $request->name,
            'cite' => $request->cite,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect('organizations');
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
            return redirect('organizations');
        }
        DB::table('education_organizations')
                ->where('id', $organization->id)
                ->delete();
        return redirect('organizations');
    }
}
