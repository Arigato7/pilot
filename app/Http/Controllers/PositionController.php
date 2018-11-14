<?php

namespace Pilot\Http\Controllers;

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

    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function create() {

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
