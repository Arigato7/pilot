<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Список новостей
     *
     * @return void
     */
    public function index() {
                        
        $newNews = DB::table('news')
                        ->join('users', 'news.user_id', '=', 'users.id')
                        ->join('user_infos', 'news.user_id', '=', 'user_infos.user_id')
                        ->select('news.header', 'news.theme', 'news.description', 'news.date', 'news.id', 'users.login as user_login', 'user_infos.name as user_name')
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
        return view('news.show', [
            'news' => $news
        ]);
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
     * Форма редактирования новости
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {

    }
    /**
     * Запись новости в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $messages = [
            'theme.required' => 'Укажите тему новости',
            'header.required' => 'Укажите заголовок новости',
            'description.required' => 'Укажите краткое описание новости',
            'content.required' => 'Укажите содержимое новости',
        ];
        $validator = Validator::make($request->all(), [
            'theme' => 'required|max:255',
            'header' => 'required|max:255',
            'description' => 'required|max:2000',
            'content' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()
                        ->route('news.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $news = new News;

        $news->user_id = Auth::user()->id;
        $news->header = $request->header;
        $news->theme = $request->theme;
        $news->description = $request->description;
        $news->content = $request->content;

        $news->save();

        return redirect()->route('news');
    }
    /**
     * Обновленние данных новости в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

    }
    /**
     * Удаление данных новости из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {

    }
}
