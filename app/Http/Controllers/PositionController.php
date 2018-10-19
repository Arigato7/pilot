<?php

namespace Pilot\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function list() {

    }

    public function create() {

    }

    public function store() {

    }

    public function update() {

    }

    public function delete() {
        
    }
}
