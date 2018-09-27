<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Subject;
use Pilot\Specialty;
use Pilot\PracticalWork;
use Illuminate\Http\Request;

class PracticalWorkController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Список практических занятий
     *
     * @return void
     */
    public function list() {
        return view('practical.list');
    }
    /**
     * Форма создания практического занятия
     *
     * @return void
     */
    public function create() {
        return view('practical.create', [
            'specialties' => Specialty::all()->sortByDesc('name'),
            'subjects' => Subject::all()->sortByDesc('name')
        ]);
    }
    /**
     * Форма редактирования данных практического занятия
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {
        return view('practical.edit');
    }
    /**
     * Страница с практическим занятием
     *
     * @param int $id
     * @return void
     */
    public function show($id) {

    }
    /**
     * Запись практического занятия 
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $messages = [
            'name.required' => 'Укажите название практической работы',
            'specialty.required' => 'Укажите специальность',
            'subject.required' => 'Укажите дисциплину',
            'resource.required' => 'Укажите ссылку на ресурс',
            'resource.url' => 'Ссылка на ресурс должна быть URL-адресом',
            'description.required' => 'Укажите описание',
            'description.max' => 'Описание не должно быть длиннее 2000 символов',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'specialty' => 'required',
            'subject' => 'required',
            'resource' => 'required|url|max:255',
            'description' => 'required|max:2000',
            'date' => 'date'
        ], $messages);
        if ($validator->fails()) {
            return redirect('practical-work/create')
                        ->withErrors($validator)
                        ->withInput();
        }

    }
    /**
     * Обновление данных практического занятия в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

    }
    /**
     * Удаление практического занятия из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {

    }
}
