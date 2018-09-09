<?php

namespace Pilot\Http\Controllers;

use Pilot\Specialty;
use Pilot\SpecialtyType;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function list() {
        return view('specialties.list', [
            'specialties' => Specialty::all()->sortByDesc('name'),
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }
    public function create() {
        return view('specialties.create', [
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }
    public function edit($id) {
        return view('specialties.edit', [
            'specialty' => Specialty::findOrFail($id),
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }

    public function store(Request $request) {

    }
    public function update(Request $request, $id) {

    }
    public function delete($id) {

    }
}
