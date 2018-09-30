<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Subject;
use Pilot\Specialty;
use Pilot\PracticalWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PracticalWorkController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Список практических занятий
     *
     * @return void
     */
    public function list() {

        $specialties = DB::table('specialties')
                            ->select('id', 'name', 'code')
                            ->orderBy('name')
                            ->take(5)
                            ->get();
        $subjects = DB::table('subjects')
                            ->select('id', 'name')
                            ->orderBy('name')
                            ->take(5)
                            ->get();

        $practicalWorks = PracticalWork::all()->sortByDesc('date');

        return view('practical.list', [
            'specialties' => $specialties,
            'subjects' => $subjects,
            'practicals' => $practicalWorks
        ]);
    }
    /**
     * Форма создания практического занятия
     *
     * @return void
     */
    public function create() {
        return view('practical.create', [
            'specialties' => Specialty::all()->sortByDesc('name'),
            'subjects' => Subject::all()->sortByDesc('name')
        ]);
    }
    /**
     * Форма редактирования данных практического занятия
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {
        return view('practical.edit');
    }
    /**
     * Страница с практическим занятием
     *
     * @param int $id
     * @return void
     */
    public function show($id) {

        $practical = PracticalWork::findOrFail($id);

        return view('practical.show');
    }
    /**
     * Запись практического занятия 
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        date_default_timezone_set("Europe/Samara");

        $messages = [
            'name.required' => 'Укажите название практической работы',
            'specialty.required' => 'Укажите специальность',
            'subject.required' => 'Укажите дисциплину',
            'resource.required' => 'Укажите ссылку на ресурс',
            'resource.url' => 'Ссылка на ресурс должна быть URL-адресом',
            'description.required' => 'Укажите описание',
            'description.max' => 'Описание не должно быть длиннее 2000 символов',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'specialty' => 'required',
            'subject' => 'required',
            'resource' => 'required|url|max:255',
            'description' => 'required|max:2000',
            'date' => 'date'
        ], $messages);
        if ($validator->fails()) {
            return redirect('practical-work/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $practical = PracticalWork::create([
            'user_id' => Auth::user()->id,
            'specialty_id' => $request->specialty,
            'subject_id' => $request->subject,
            'name' => $request->name,
            'resource' => $request->resource,
            'description' => $request->description,
            'date' => date( "Y-m-d H:i:s", strtotime('now'))
        ]);

        return redirect('practical-work/' . $practical->id);
    }
    /**
     * Обновление данных практического занятия в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

    }
    /**
     * Удаление практического занятия из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {

    }
}
