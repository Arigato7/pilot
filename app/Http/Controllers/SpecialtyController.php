<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Specialty;
use Pilot\SpecialtyType;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }
    /**
     * Список специальностей
     *
     * @return void
     */
    public function list() {
        return view('specialties.list', [
            'specialties' => Specialty::all()->sortByDesc('name'),
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }
    /**
     * Форма создания специальности
     *
     * @return void
     */
    public function create() {
        return view('specialties.create', [
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }
    /**
     * Форма редактирования специальности
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {
        return view('specialties.edit', [
            'specialty' => Specialty::findOrFail($id),
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }
    /**
     * Запись данных специальности в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $messages = [
            'name.required' => 'Укажите название специальности',
            'type.required' => 'Укажите тип специальности',
            'code.required' => 'Укажите код специальности',
            'code.regex' => 'Неверный формат кода специальности',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'code' => 'required|regex:[[0-9]{2}\.[0-9]{2}\.[0-9]{2}]',
            'type' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()
                        ->route('specialties')
                        ->withErrors($validator)
                        ->withInput();
        }

        $specialty = new Specialty;

        $specialty->specialty_type_id = $request->type;
        $specialty->name = $request->name;
        $specialty->code = $request->code;

        $specialty->save();

        return redirect()->route('specialties');
    }
    /**
     * Обновление данных специальности в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

    }
    /**
     * Удаление специальности из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        Specialty::findOrFail($id)->delete();
        return redirect()->route('specialties');
    }
}
