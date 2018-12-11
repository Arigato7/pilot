<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function list() {
        return view('organizations.position.list', [
            'positions' => Position::all()->sortByDesc('name')
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
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->route('positions')
                        ->withErrors($validator)
                        ->withInput();
        }

        $position = new Position;

        $position->name = $request->name;

        $position->save();

        return redirect()->route('positions');
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
        Position::findOrFail($id)->delete();
        return redirect()->route('positions');
    }
}
