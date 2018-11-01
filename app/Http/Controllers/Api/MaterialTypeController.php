<?php

namespace Pilot\Http\Controllers\Api;

use Pilot\MaterialType;
use Illuminate\Http\Request;
use Pilot\Http\Controllers\Controller;

class MaterialTypeController extends Controller
{
    
    /**
     * Получение списка типов материала
     *
     * @return void
     */
    public function getAllMaterialTypes() {
        return MaterialType::all()->sortByDesc('name');
    }
    /**
     * Добавление типа материала в БД
     *
     * @param Request $request
     * @return void
     */
    public function addMaterialType(Request $request) {

    }
    /**
     * Обновление данных типа материала в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function updateMaterialType(Request $request, $id) {

    }
    /**
     * Undocumented function
     *
     * @param int $id
     * @return void
     */
    public function deleteMaterialType($id) {
        MaterialType::findOrFail($id)->delete();
        return redirect('material-types');
    }
}
