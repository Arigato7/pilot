<?php

namespace Pilot\Http\Controllers;

use Gate;
use DateTime;
use Validator;
use Pilot\User;
use Pilot\Course;
use Pilot\CourseType;
use Pilot\CourseFile;
use Pilot\CourseRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Pilot\Events\CourseSubscribed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.teacher');
    }
    /**
     * Список с курсами
     *
     * @return void
     */
    public function list() {
        date_default_timezone_set("Europe/Samara");

        return view('course.list', [
            'courses' => Course::all()->sortByDesc('date'),
            'types' => CourseType::all()->sortByDesc('name')
        ]);
    }
    /**
     * Возвращает объект DateTime из строки
     *
     * @param string $format
     * @param string $date
     * @return void
     */
    protected function dateTimeFromString($format, $date) {
        return new DateTime(date($format, strtotime($date)));
    }
    /**
     * Валидация данных
     *
     * @param Request $request
     * @param [type] $rules
     * @param [type] $messages
     * @param [type] $redirect
     * @return void
     */
    protected function validateRequest(Request $request, $rules, $messages, $redirect) {
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect($redirect)
                        ->withErrors($validator)
                        ->withInput();
        }
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    protected function validateUpdatedCourse(Request $request, $id) {
        $this->validateRequest($request, [
            'name' => 'required|max:255',
            'type' => 'required',
            'start_date' => 'required_with:start_time|required|date',
            'start_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'end_date' => 'required_with:end_time|required|date',
            'end_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'end_entry_date' => 'required_with:end_entry_time|required|date',
            'end_entry_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'duration' => 'required|numeric',
            'place' => 'required|max:255',
            'description' => 'required'
        ], [
            'name.required' => 'Укажите название курса',
            'type.required' => 'Укажите тип курса',
            'start_date.required_with' => 'Теперь укажите дату начала',
            'start_time.required' => 'Укажите время начала',
            'start_date.required' => 'Укажите дату начала',
            'end_date.required_with' => 'Теперь укажите дату завершения',
            'end_time.required' => 'Укажите время завершения',
            'end_date.required' => 'Укажите дату завершения',
            'end_entry_date.required_with' => 'Теперь укажите дату завершения записи',
            'end_entry_time.required' => 'Укажите время завершения записи',
            'end_entry_date.required' => 'Укажите дату завершения записи',
            'place.required' => 'Укажите место проведения',
            'duration.required' => 'Укажите количество часов',
            'duration.numeric' => 'Сдесь должно быть число',
            'description.required' => 'Укажите описание'
        ], route('courses.edit', ['id' => $id]));
    }
    /**
     * Страница с курсом
     *
     * @param int $id
     * @return void
     */
    public function show($id) {
        date_default_timezone_set("Europe/Samara");
        $course = Course::findOrFail($id);

        $currentDate = $this->dateTimeFromString("d.m.Y H:i:s", "now");
        $endEntryDate = $this->dateTimeFromString("d.m.Y H:i:s", $course->end_entry_date);
        $diffDateBool = $currentDate <= $endEntryDate;

        $comments = DB::table('course_comments')
                            ->join('users', 'course_comments.user_id', '=', 'users.id')
                            ->join('user_infos', 'course_comments.user_id', '=', 'user_infos.user_id')
                            ->select('course_comments.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.lastname as user_lastname', 'user_infos.rate as user_rate')
                            ->where('course_comments.course_id', $course->id)
                            ->orderBy('date', 'desc')
                            ->get();

        $participants = DB::table('course_records')
                            ->select('user_id')
                            ->distinct()
                            ->get();

        $files = CourseFile::where('course_id', $course->id)->get();
        $fileTypes = [
            'txt' => 'file-text-o',
            'pdf' => 'file-pdf-o',
            'xls' => 'file-excel-o',
            'xlsx' => 'file-excel-o',
            'doc' => 'file-word-o',
            'docx' => 'file-word-o',
            'ppt' => 'file-powerpoint-o',
            'pptx' => 'file-powerpoint-o',
            'zip' => 'file-zip-o',
            'rar' => 'file-zip-o',
            '7z' => 'file-zip-o',
            'png' => 'file-picture-o',
            'jpg' => 'file-picture-o',
        ];
        $fileSizes = [];

        foreach ($files as $file) {
            $fileSizes[$file->fullname] = round((Storage::size('public/courses/' . $file->course_id . '/' . $file->fullname) / 1024) / 1024, 1, PHP_ROUND_HALF_EVEN);
        }

        return view('course.show', [
            'course' => $course,
            'date_diff' => $diffDateBool,
            'comments' => $comments,
            'members_count' => $participants->count(),
            'files' => $files,
            'fileTypes' => $fileTypes,
            'fileSizes' => $fileSizes,
        ]);
    }
    /**
     * Форма создания курса
     *
     * @return void
     */
    public function create() {

        $types = DB::table('course_types')
                        ->select('id', 'name')
                        ->orderBy('created_at')
                        ->get();

        return view('course.create', [
            'types' => $types
        ]);
    }
    /**
     * Форма редактирования курса
     *
     * @param int $id
     * @return void
     */
    public function edit($id) {
        $course = Course::findOrFail($id);
        return view('course.edit', [
            'course' => $course,
            'types' => CourseType::all()->sortByDesc('name'),
            'start_date' => date('Y-m-d', strtotime(explode(' ', $course->start_date)[0])),
            'start_time' => explode(' ', $course->start_date)[1],
            'end_date' => date('Y-m-d', strtotime(explode(' ', $course->end_date)[0])),
            'end_time' => explode(' ', $course->end_date)[1],
            'end_entry_date' => date('Y-m-d', strtotime(explode(' ', $course->end_entry_date)[0])),
            'end_entry_time' => explode(' ', $course->end_entry_date)[1],
        ]);
    }
    /**
     * Запись данных курса в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $messages = [
            'name.required' => 'Укажите название курса',
            'type.required' => 'Укажите тип курса',
            'start_date.required_with' => 'Теперь укажите дату начала',
            'start_time.required' => 'Укажите время начала',
            'start_date.required' => 'Укажите дату начала',
            'end_date.required_with' => 'Теперь укажите дату завершения',
            'end_time.required' => 'Укажите время завершения',
            'end_date.required' => 'Укажите дату завершения',
            'end_entry_date.required_with' => 'Теперь укажите дату завершения записи',
            'end_entry_time.required' => 'Укажите время завершения записи',
            'end_entry_date.required' => 'Укажите дату завершения записи',
            'place.required' => 'Укажите место проведения',
            'duration.required' => 'Укажите количество часов',
            'duration.numeric' => 'Сдесь должно быть число',
            'description.required' => 'Укажите описание'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type' => 'required',
            'start_date' => 'required_with:start_time|required|date',
            'start_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'end_date' => 'required_with:end_time|required|date',
            'end_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'end_entry_date' => 'required_with:end_entry_time|required|date',
            'end_entry_time' => 'required|regex:[[0-9]{2}:[0-9]{2}]',
            'duration' => 'required|numeric',
            'place' => 'required|max:255',
            'description' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect('course/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $startDate = $request->start_date . ' ' . $request->start_time;
        $endDate = $request->end_date . ' ' . $request->end_time;
        $endEntryDate = $request->end_entry_date . ' ' . $request->end_entry_time;

        $startDateTime = $this->dateTimeFromString("d.m.Y H:i:s", $startDate);
        $endEntryDateTime = $this->dateTimeFromString("d.m.Y H:i:s", $endEntryDate);

        $endEntryDateTimeString = $startDateTime
                                ->diff($this->dateTimeFromString("d.m.Y H:i:s", $endEntryDate))
                                ->invert == 0
                                ? $endEntryDateTime->sub(date_interval_create_from_date_string('1 day'))->format("Y-m-d H:i:s")
                                : $endEntryDateTime->format("Y-m-d H:i:s");

        $course = Course::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'course_type_id' => $request->type,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'end_entry_date' => $endEntryDateTimeString,
            'duration' => $request->duration,
            'place' => $request->place,
            'description' => $request->description
        ]);

        return redirect('course/' . $course->id);
    }
    /**
     * Запись на курс
     *
     * @param int $id
     * @param Request $request
     * @return void
     */
    public function enrollment($id, Request $request) {

        $course = Course::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'date' => 'required|before:' . $course->end_entry_date
        ]);

        $record = null;

        if (! $validator->fails()) {
            $record = new CourseRecord;

            $record->course_id = $course->id;
            $record->user_id = Auth::user()->id;
            $record->date = $request->date;

            $record->save();

            event(new CourseSubscribed($record));
        }
        
        return redirect()->route('courses.show', [
            'id' => $course->id
        ]);
    }
    /**
     * Отписка от курса
     *
     * @param int $id
     * @return boolean
     */
    public function cancellation($id) {
        $course = Course::findOrFail($id);
        
        DB::table('course_records')
            ->where('user_id', Auth::user()->id)
            ->where('course_id', $course->id)
            ->delete();

        return redirect()->route('courses.show', [
            'id' => $course->id
        ]);
    }
    /**
     * Обновление данных курса в БД
     *
     * @param int $id
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id) {

        $course = Course::findOrFail($id);

        $this->validateUpdatedCourse($request, $course->id);

        $startDate = $request->start_date . ' ' . $request->start_time;
        $endDate = $request->end_date . ' ' . $request->end_time;
        $endEntryDate = $request->end_entry_date . ' ' . $request->end_entry_time;

        $course->name = $request->name;
        $course->course_type_id = $request->type;
        $course->start_date = $startDate;
        $course->end_date = $endDate;
        $course->end_entry_date = $endEntryDate;
        $course->duration = $request->duration;
        $course->place = $request->place;
        $course->description = $request->description;

        $course->save();

        return redirect()->route('courses.show', ['id' => $course->id]);
    }
    /**
     * Удаление курса
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        Course::findOrFail($id)->delete();
        return redirect()->route('courses');
    }
}
