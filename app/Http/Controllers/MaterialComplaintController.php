<?php

namespace Pilot\Http\Controllers;

use Gate;
use Validator;
use Pilot\Material;
use Pilot\MaterialComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MaterialComplaintController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index() {
        if (Gate::denies('moderate', Auth::user())) {
            return redirect('materials');
        }
        // $complaints = MaterialComplaint::all()->sortByDesc('date');
        $complaints = DB::table('material_complaints')
                        ->join('users', 'material_complaints.user_id', '=', 'users.id')
                        ->join('materials', 'material_complaints.material_id', '=', 'materials.id')
                        ->select('materials.name as material_name', 'materials.id as material_id', 'users.login as user_login')
                        ->orderByDesc('material_complaints.date')
                        ->get();

        return view('material.complaint.list', [
            'complaints' => $complaints
        ]);
    }
    /**
     * Undocumented function
     *
     * @param [type] $material_id
     * @return void
     */
    public function create($material_id) {
        $material = Material::findOrFail($material_id);

        return view('material.complaint.complaint', [
            'material' => $material
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:2000',
        ]);

        $material = Material::findOrFail($request->material_id);

        if ($validator->fails()) {
            return redirect('complaint/create/' . $material->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        MaterialComplaint::create([
            'user_id' => Auth::user()->id,
            'material_id' => $material->id,
            'description' => $request->description
        ]);

        return redirect('material/' . $material->id);
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id) {
        if (Gate::denies('moderate', Auth::user())) {
            abort(403, 'У вас нет прав на удаление жалобы.');
        }
    }
}
