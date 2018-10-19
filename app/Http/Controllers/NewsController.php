<?php

namespace Pilot\Http\Controllers;

use Pilot\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Список новостей
     *
     * @return void
     */
    public function index() {
                        
        $newNews = DB::table('news')
                        ->join('users', 'news.user_id', '=', 'users.id')
                        ->join('user_infos', 'news.user_id', '=', 'user_infos.user_id')
                        ->select('news.header', 'news.theme', 'news.is_notification', 'news.date', 'news.id', 'users.login as user_login', 'user_infos.name as user_name')
                        ->orderBy('news.date', 'desc')
                        ->take(5)
                        ->get();

        return view('news.list', [
            'newNews' => $newNews
        ]);
    }
    /**
     * Страница с новостью
     *
     * @param int $id
     * @return void
     */
    public function show($id) {
        $news = News::findOrFail($id);
        return view('news.show');
    }
    /**
     * Форма создания новости
     *
     * @return void
     */
    public function create() {
        return view('news.create');
    }
    /**
     * Запись новости в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        
    }
}
