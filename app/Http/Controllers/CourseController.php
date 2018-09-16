<?php

namespace Pilot\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function list() {
        return view('course.list');
    }
    public function show($id) {
        return view('course.show');
    }
    public function create() {
        return view('course.create');
    }
    public function store(Request $request) {
        $messages = [
            'name.required' => 'Укажите название курса',
            'start_date.required_with' => 'Теперь укажите дату начала',
            'start_time.required' => 'Укажите время начала',
            'start_date.required' => 'Укажите дату начала',
            'end_date.required_with' => 'Теперь укажите дату завершения',
            'end_time.required' => 'Укажите время завершения',
            'end_date.required' => 'Укажите дату завершения',
            'place.required' => 'Укажите место проведения',
            'description.required' => 'Укажите описание'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'start_date' => 'required_with:start_time|required|date',
            'start_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'end_date' => 'required_with:end_time|required|date',
            'end_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'place' => 'required|max:255',
            'description' => 'required|max:255'
        ], $messages);
        if ($validator->fails()) {
            return redirect('course/create')
                        ->withErrors($validator)
                        ->withInput();
        }
    }
    public function update($id, Request $request) {

    }
    public function delete($id) {
        
    }
}
