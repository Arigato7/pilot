<?php

namespace Pilot\Http\Controllers\Api;

use Pilot\MaterialType;
use Illuminate\Http\Request;
use Pilot\Http\Controllers\Controller;

class MaterialTypeController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllMaterialTypes() {
        return MaterialType::all()->sortByDesc('name');
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function addMaterialType(Request $request) {

    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function updateMaterialType(Request $request, $id) {

    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteMaterialType($id) {
        MaterialType::findOrFail($id)->delete();
        return true;
    }
}
