<?php

namespace Pilot\Http\Controllers;

use Pilot\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Список дисциплин
     *
     * @return void
     */
    public function list() {
        return view('subjects.list', [
            'subjects' => Subject::all()->sortByDesc('name')
        ]);
    }
    /**
     * Форма создания дисциплины
     *
     * @return void
     */
    public function create() {

    }
    /**
     * Форма редактирования дисциплины
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {

    }
    /**
     * Запись данных дисциплины в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {

    }
    /**
     * Обновление данных дисциплины в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

    }
    /**
     * Удаление дисциплины из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {

    }
}
