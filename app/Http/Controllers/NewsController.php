<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    protected function createDirectory($directory) {
        if (! Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
    }

    protected function deleteFile($path) {
        return Storage::disk('local')->delete($path);
    }

    protected function imageFileName($fileName) {
        return 'I_' . substr(md5(date('d_m_o_His')), 0, 16)
                . '.'
                . pathinfo($fileName, PATHINFO_EXTENSION);
    }
    /**
     * Список новостей
     *
     * @return void
     */
    public function index() {
                        
        $news = DB::table('news')
                ->join('users', 'news.user_id', '=', 'users.id')
                ->join('user_infos', 'news.user_id', '=', 'user_infos.user_id')
                ->select('news.header', 'news.image', 'news.description', 'news.date', 'news.id', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.lastname as user_lastname')
                ->orderBy('news.date', 'desc')
                ->get();

        return view('news.list', [
            'news' => $news
        ]);
    }
    /**
     * Страница с новостью
     *
     * @param int $id
     * @return void
     */
    public function show($id) {

        $news = DB::table('news')
                ->join('users', 'news.user_id', '=', 'users.id')
                ->join('user_infos', 'news.user_id', '=', 'user_infos.user_id')
                ->select('news.header', 'news.image', 'news.description', 'news.date', 'news.id', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.lastname as user_lastname')
                ->where('news.id', $id)
                ->orderBy('news.date', 'desc')
                ->first();

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
        return view('news.edit', [
            'news' => News::findOrFail($id)
        ]);
    }
    /**
     * Запись новости в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $messages = [
            'header.required' => 'Укажите заголовок новости',
            'image.image' => 'Загруженный файл должен быть изображением',
            'image.max' => 'Размер файла не должен превышать 7 мегабайт',
            'description.required' => 'Укажите содержимое новости',
        ];
        $validator = Validator::make($request->all(), [
            'header' => 'required|max:255',
            'image' => 'file|image|max:7168|nullable',
            'description' => 'required',
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
        $news->description = $request->description;

        $this->createDirectory('/public/images');
        $imageName = '';
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $imageName = $this->imageFileName($fileName);
            Storage::putFileAs('public/images', $file, $imageName);
        }

        $news->image = $request->image != null ? $imageName : null;

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
        $messages = [
            'header.required' => 'Укажите заголовок новости',
            'image.image' => 'Загруженный файл должен быть изображением',
            'description.required' => 'Укажите содержимое новости',
        ];
        $validator = Validator::make($request->all(), [
            'header' => 'required|max:255',
            'image' => 'file|image|nullable',
            'description' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()
                        ->route('news.edit')
                        ->withErrors($validator)
                        ->withInput();
        }
    }
    /**
     * Удаление данных новости из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        $news = News::findOrFail($id);
        if ($news->image != null) {
            $this->deleteFile('/public/news/' . $news->image);
        }
        $news->delete();
        return redirect()->route('news');
    }
}
