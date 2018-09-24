<?php

namespace Pilot\Http\Controllers;

use Pilot\Specialty;
use Pilot\SpecialtyType;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @return void
     */
    public function create() {
        return view('specialties.create', [
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id) {
        return view('specialties.edit', [
            'specialty' => Specialty::findOrFail($id),
            'specialtyTypes' => SpecialtyType::all()->sortByDesc('name')
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {

    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id) {

    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id) {

    }
}
