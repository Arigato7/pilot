<?php

namespace Pilot\Http\Controllers;

use Gate;
use Validator;
use Pilot\User;
use Pilot\Subject;
use Pilot\Material;
use Pilot\Specialty;
use Pilot\MaterialType;
use Pilot\MaterialComment;
use Illuminate\Http\Request;
use Pilot\Events\MaterialCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Pilot\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class MaterialController extends Controller
{
    /**
     * Файл материала
     *
     * @var string
     */
    protected $content;
    /**
     * Временно удаленный файл материала
     *
     * @var string
     */
    protected $deleted = null;

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.teacher');
    }
    /**
     * Вывод списка с материалами
     *
     * @return void
     */
    public function index() {

        $newMaterials = DB::table('materials')
                            ->join('users', 'materials.user_id', '=', 'users.id')
                            ->join('user_infos', 'materials.user_id', '=', 'user_infos.user_id')
                            ->where('materials.deleted_at', null)
                            ->select('materials.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.photo as user_photo')
                            ->orderBy('materials.date', 'desc')
                            ->take(5)
                            ->get();
                            
        $specialties = DB::table('specialties')->select('id', 'name', 'code')->orderBy('name')->take(5)->get();
        $subjects = DB::table('subjects')->select('id', 'name')->orderBy('name')->take(5)->get();
        $types = DB::table('material_types')->select('id', 'name')->orderBy('name')->take(5)->get();

        return view('material.list', [
            'newMaterials' => $newMaterials,
            'specialties' => $specialties,
            'subjects' => $subjects,
            'types' => $types
        ]);
    }
    /**
     * Вывод страницы материала
     *
     * @param int $id
     * @return void
     */
    public function show($id) {
        $material = Material::findOrFail($id);

        $error = !$material ? 'Данный материал не существует, либо он удален!' : '';

        $specialty = Specialty::findOrFail($material->specialty_id);

        $subject = Subject::findOrFail($material->subject_id);

        $type = MaterialType::findOrFail($material->material_type_id);

        $user = User::findOrFail($material->user_id);

        $userInfo = DB::table('user_infos')->where('user_id', $material->user_id)->first();

        $comments = DB::table('material_comments')
                        ->join('users', 'material_comments.user_id', '=', 'users.id')
                        ->join('user_infos', 'material_comments.user_id', '=', 'user_infos.user_id')
                        ->select('material_comments.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.photo as user_photo', 'user_infos.rate as user_rate')
                        ->where('material_comments.material_id', $material->id)
                        ->orderBy('date', 'desc')
                        ->get();
        
        return view('material.show', [
            'material' => $material,
            'specialty' => $specialty,
            'subject' => $subject,
            'type' => $type,
            'user' => $user,
            'userInfo' => $userInfo,
            'comments' => $comments,
            'error' => $error
        ]);
    }
    /**
     * Форма создания материала
     *
     * @return void
     */
    public function create() {
        $specialties = DB::table('specialties')->select('id', 'name')->get();

        $subjects = DB::table('subjects')->select('id', 'name')->get();

        $types = MaterialType::all()->sortByDesc('name');

        return view('material.create', [
            'specialties' => $specialties,
            'subjects' => $subjects,
            'types' => $types
        ]);
    }
    /**
     * Вывод материалов по типу
     *
     * @param int $id
     * @return void
     */
    public function typeMaterial($id) {
        $type = MaterialType::findOrFail($id);

        $materials = DB::table('materials')
                                ->join('users', 'materials.user_id', '=', 'users.id')
                                ->join('user_infos', 'materials.user_id', '=', 'user_infos.user_id')
                                ->select('materials.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.photo as user_photo')
                                ->where('materials.deleted_at', null)
                                ->where('materials.material_type_id', $type->id)
                                ->orderBy('date', 'desc')
                                ->get();

        $title = 'Материалы по типу ' . $type->name;

        return view('material.filter', [
            'materials' => $materials,
            'title' => $title
        ]);
    }
    /**
     * Вывод материалов по пользователю
     *
     * @param int $id
     * @return void
     */
    public function usersMaterials($id) {
        $user = User::findOrFail($id);

        $materials = DB::table('materials')
                                ->join('users', 'materials.user_id', '=', 'users.id')
                                ->join('user_infos', 'materials.user_id', '=', 'user_infos.user_id')
                                ->select('materials.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.photo as user_photo')
                                ->where('materials.deleted_at', null)
                                ->where('materials.user_id', $id)
                                ->orderBy('date', 'desc')
                                ->get();

        $title = 'Материалы пользователя ' . $user->userInfo->name;

        return view('material.filter', [
            'materials' => $materials,
            'title' => $title
        ]);
    }
    /**
     * Вывод материалов по дисциплине
     *
     * @param int $id
     * @return void
     */
    public function subjectMaterials($id) {
        $subject = Subject::findOrFail($id);

        $materials = DB::table('materials')
                                ->join('users', 'materials.user_id', '=', 'users.id')
                                ->join('user_infos', 'materials.user_id', '=', 'user_infos.user_id')
                                ->select('materials.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.photo as user_photo')
                                ->where('materials.deleted_at', null)
                                ->where('materials.subject_id', $id)
                                ->orderBy('date', 'desc')
                                ->get();

        $title = 'Материалы по дисциплине ' . $subject->name;
        return view('material.filter', [
            'materials' => $materials,
            'title' => $title
        ]);
    }
    /**
     * Вывод материалов по специальности
     *
     * @param int $id
     * @return void
     */
    public function specialtyMaterials($id) {
        $specialty = Specialty::findOrFail($id);

        $materials = DB::table('materials')
                                ->join('users', 'materials.user_id', '=', 'users.id')
                                ->join('user_infos', 'materials.user_id', '=', 'user_infos.user_id')
                                ->select('materials.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.photo as user_photo')
                                ->where('materials.deleted_at', null)
                                ->where('materials.specialty_id', $id)
                                ->orderBy('date', 'desc')
                                ->get();

        $title = 'Материалы по специальности ' . $specialty->name;
        return view('material.filter', [
            'materials' => $materials,
            'title' => $title
        ]);
    }
    /**
     * Создание директорий файлов материалов
     *
     * @param string $currentDirectory
     * @param string $deletedDirectory
     * @return void
     */
    protected function createMaterialDirectories($currentDirectory, $deletedDirectory) {
        if (! Storage::exists($currentDirectory) && ! Storage::exists($deletedDirectory)) {
            Storage::makeDirectory($currentDirectory);
            Storage::makeDirectory($deletedDirectory);
        }
    }
    /**
     * Создание имени файла материала
     *
     * @param string $fileName
     * @return void
     */
    protected function materialFileName($fileName) {
        return date('d_m_o_His') 
                . '_'
                . pathinfo($fileName, PATHINFO_FILENAME) 
                . '.'
                . pathinfo($fileName, PATHINFO_EXTENSION);
    }
    /**
     * Запись  материала в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $messages = [
            'name.required' => 'Укажите название материала',
            'type.required' => 'Укажите тип материала',
            'specialty.required' => 'Укажите специальность',
            'subject.required' => 'Укажите дисциплину',
            'description.required' => 'Укажите описание материала',
            'content.required' => 'Укажите файл материала',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type' => 'required',
            'specialty' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'content' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,txt,zip,gzip,rar,7z'
        ], $messages);
        if ($validator->fails()) {
            return redirect('material/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->createMaterialDirectories("/public/materials/" . Auth::user()->login . "/actual",
                                         "/public/materials/" . Auth::user()->login . "/deleted");

        if ($request->hasFile('content')) {
            $file = $request->file('content');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('/public/materials/' 
                        . Auth::user()->login 
                        . '/actual', $this->materialFileName($fileName));
            $this->content = $this->materialFileName($fileName);
        }

        $material = new Material;

        $material->user_id = Auth::user()->id;
        $material->name = $request->name;
        $material->specialty_id = $request->specialty;
        $material->subject_id = $request->subject;
        $material->material_type_id = $request->type;
        $material->description = $request->description;
        $material->content = $this->content;
        $material->status = 'new';

        $material->save();

        event(new MaterialCreated($material));
        return redirect('material/' . $material->id);
    }
    /**
     * Обновление данных материала в БД
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id) {

        $material = Material::findOrFail($id);

        if (Gate::denies('update-material', $material)) {
            abort(403, 'У вас нет прав на редактирование данного материала');
        }
        $messages = [
            'name.required' => 'Укажите название материала',
            'type.required' => 'Укажите тип материала',
            'specialty.required' => 'Укажите специальность',
            'subject.required' => 'Укажите дисциплину',
            'description.required' => 'Укажите описание материала',
            'content.required' => 'Укажите файл материала',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type' => 'required',
            'specialty' => 'required',
            'subject' => 'required|max:255',
            'description' => 'required',
            'content' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,txt,zip,gzip,rar,7z'
        ], $messages);
        if ($validator->fails()) {
            return redirect('material/' . $material->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->hasFile('content')) {
            $file = $request->file('content');
            
            if (Storage::exists('/public/materials/' . Auth::user()->login . '/actual/' . $material->content)) {
                $this->moveMaterialFile('/public/materials/' . Auth::user()->login . '/actual/' . $material->content,
                                        '/public/materials/' . Auth::user()->login . '/deleted/' . $material->content);
                $this->deleted = $material->content;
            }
            
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('/public/materials/' 
                        . Auth::user()->login . '/actual', $this->materialFileName($fileName));
            $this->content = $this->materialFileName($fileName);
        }

        $material->user_id = Auth::user()->id;
        $material->name = $request->name;
        $material->specialty_id = $request->specialty;
        $material->subject_id = $request->subject;
        $material->material_type_id = $request->type;
        $material->description = $request->description;
        $material->content = $this->content;
        $material->status = 'updated';
        $material->deleted = $this->deleted;

        $material->save();

        return redirect('material/'. $material->id);
    }
    /**
     * Форма редактирования материала
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {
        $material = Material::findOrFail($id);
        
        $specialties = DB::table('specialties')->select('id', 'name')->get();

        $subjects = DB::table('subjects')->select('id', 'name')->get();

        $types = DB::table('material_types')->select('id', 'name')->get();
        
        return view('material.edit', [
            'material' => $material,
            'specialties' => $specialties,
            'subjects' => $subjects,
            'types' => $types
        ]);
    }
    /**
     * Удаление файла материала
     *
     * @param string $path
     * @return void
     */
    protected function deleteMaterialFile($path) {
        Storage::disk('public')->delete($path);
    }
    /**
     * Undocumented function
     *
     * @param string $from
     * @param string $to
     * @return void
     */
    protected function moveMaterialFile($from, $to) {
        if (! Storage::exists($to)) {
            Storage::move($from, $to);
        }
    }
    /**
     * Мягкое удаление материала
     *
     * @param int $id
     * @return void
     */
    public function deleteTemp($id) {

        $material = Material::findOrFail($id);
        $user = User::findOrFail($material->user_id);

        $material->status = 'deleted';
        $material->who_deleted = Auth::user()->login;
        $material->save();

        $this->deleteMaterialFile('app/public/materials/' . $user->login . '/deleted/' . $material->deleted);
        $this->moveMaterialFile('/public/materials/' . $user->login . '/actual/' . $material->content,
                                '/public/materials/' . $user->login . '/deleted/' . $material->content);

        $material->deleted = $material->content;

        $material->save();
        $material->delete();

        return redirect('materials');
    }
    /**
     * Удаление материала из БД с удалением его файла
     *
     * @param int $id
     * @return void
     */
    public function deleteForever($id) {
        $material = Material::findOrFail($id);
        $user = User::findOrFail($material->user_id);

        if (Storage::exists('/public/materials/' . $user->login . '/actual/' . $material->content)) {
            $this->deleteMaterialFile('/public/materials/' . $user->login . '/actual/' . $material->content);
            if (Storage::exists('/public/materials/' . $user->login . '/deleted/' . $material->deleted)) {
                $this->deleteMaterialFile('/public/materials/' . $user->login . '/deleted/' . $material->deleted);
            }
            $material->forceDelete();

            return redirect('materials');
        }
        
        return redirect()->route('materials.show', ['id' => $material->id]);
    }
    /**
     * Восстановление временно удаленного материала
     *
     * @param int $id
     * @return void
     */
    public function restore($id) {

        Material::onlyTrashed()
                        ->where('id', $id)
                        ->restore();

        $material = Material::findOrFail($id);

        $this->moveMaterialFile('/public/materials/' . Auth::user()->login . '/deleted/' . $material->deleted,
                                '/public/materials/' . Auth::user()->login . '/actual/' . $material->deleted);

        $material->content = $material->deleted;
        $material->deleted = null;
        $material->status = 'restored';
        $material->save();


        return redirect('material/' . $material->id);
    }
    /**
     * Скачивание файла материала
     *
     * @param int $id
     * @return void
     */
    public function download($id) {
        $material = Material::findOrFail($id);

        $user = DB::table('users')
                            ->select('login')
                            ->where('id', $material->user_id)
                            ->first();

        $pathToFile = storage_path('app/public/materials/' . $user->login . '/actual/' . $material->content);
        return response()->download($pathToFile);
    }
}
