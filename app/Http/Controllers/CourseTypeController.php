<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\CourseType;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function list() {
        return view('course.type.list', [
            'types' => CourseType::all()->sortByDesc('name')
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('courses.types')
                        ->withErrors($validator)
                        ->withInput();
        }

        $type = new CourseType;

        $type->name = $request->name;

        $type->save();
        
        return redirect()->route('courses.types');
    }

    public function update(Request $request, $id) {

    }

    public function delete($id) {

    }
}
