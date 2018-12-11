<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.admin');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('subjects')
                        ->withErrors($validator)
                        ->withInput();
        }

        $subject = new Subject;

        $subject->name = $request->name;

        $subject->save();

        return redirect()->route('subjects');
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
        Subject::findOrFail($id)->delete();
        return redirect()->route('subjects');
    }
}
