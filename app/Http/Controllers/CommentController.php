<?php

namespace Pilot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function store(Request $request, $objectType, $objectId) {

    }
    public function delete($objectType, $objectId, $id) {
        if (Gate::denies('moderate', Auth::user())) {
            abort(403, 'Вы не имеете прав на удаление комментариев');
        }

    }
}
