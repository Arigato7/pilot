<?php

namespace Pilot\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Pilot\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function admin() {
        if (Gate::denies('administrate', Auth::user())) {
            abort(403, 'Вы не авторизованы на данное действие');
        }
        $materials = DB::table('materials')
                            ->select('id', 'name', 'date')
                            ->where('user_id', Auth::user()->id)
                            ->take(5)
                            ->get();
        $news = DB::table('news')
                            ->select('id', 'header', 'date')
                            ->where('user_id', Auth::user()->id)
                            ->take(5)
                            ->get();
        $organizations = DB::table('education_organizations')
                            ->select('id', 'name')
                            ->take(5)
                            ->get();
        $specialties = DB::table('specialties')
                            ->select('id', 'name')
                            ->take(5)
                            ->get();
        $subjects = DB::table('subjects')
                            ->select('id', 'name')
                            ->take(5)
                            ->get();
        $users = DB::table('users')
                            ->select('id', 'login')
                            ->where('id', '!=', Auth::user()->id)
                            ->take(5)
                            ->get();
        return view('admin.profile', [
            'materials' => $materials,
            'news' => $news,
            'organizations' => $organizations,
            'specialties' => $specialties,
            'subjects' => $subjects,
            'users' => $users,
        ]);
    }
}
