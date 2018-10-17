<?php

namespace Pilot\Http\Controllers\Api;

use Pilot\MaterialType;
use Illuminate\Http\Request;
use Pilot\Http\Controllers\Controller;

class MaterialTypeController extends Controller
{

    public function getAllMaterialTypes() {
        return MaterialType::all()->sortByDesc('name');
    }

    public function addMaterialType(Request $request) {

    }

    public function updateMaterialType(Request $request, $id) {

    }

    public function deleteMaterialType($id) {

    }
}
