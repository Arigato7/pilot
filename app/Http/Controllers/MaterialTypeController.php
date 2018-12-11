<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\MaterialType;
use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }
    /**
     * Список типов материалов
     *
     * @return void
     */
    public function list() {
        return view('material.type.list', [
            'types' => MaterialType::all()->sortByDesc('name')
        ]);
    }
    /**
     * Запись типа материала в БД
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
                        ->route('materials.types')
                        ->withErrors($validator)
                        ->withInput();
        }

        $type = new MaterialType;

        $type->name = $request->name;

        $type->save();

        return redirect()->route('materials.types');
    }
    /**
     * Обновление данных типа материала в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

    }
    /**
     * Удаление типа материала из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        MaterialType::findOrFail($id)->delete();
        return redirect()->route('materials.types');
    }
}
