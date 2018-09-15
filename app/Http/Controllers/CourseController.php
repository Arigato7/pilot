<?php

namespace Pilot\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function list() {
        return view('course.list');
    }
    public function show($id) {

    }
    public function create() {
        return view('course.create');
    }
    public function store(Request $request) {

    }
    public function update($id, Request $request) {

    }
    public function delete($id) {
        
    }
}
