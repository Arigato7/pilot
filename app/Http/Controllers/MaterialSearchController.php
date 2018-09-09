<?php

namespace Pilot\Http\Controllers;

use Gate;
use Validator;
use Pilot\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Scout\Searchable;

class MaterialSearchController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function find(Request $request) {
        
        $name = $request->materialName;

        return redirect('material/search/' . $name);
    }
    public function search($name) {
        $materials = Material::search($name)->get();
        return view('material.search', [
            'name' => $name,
            'materials' => $materials,
        ]);
    }
}
