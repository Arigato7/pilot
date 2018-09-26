<?php

namespace Pilot\Http\Controllers;

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
