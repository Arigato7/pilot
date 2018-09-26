<?php

namespace Pilot\Http\Controllers;

use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Список типов материалов
     *
     * @return void
     */
    public function list() {
        return view('material.type.list');
    }
    /**
     * Запись типа материала в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {

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

    }
}
