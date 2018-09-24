<?php

namespace Pilot\Http\Controllers;

use DateTime;
use Validator;
use Pilot\User;
use Pilot\Course;
use Pilot\CourseRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Pilot\Events\CourseSubscribed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Список с курсами
     *
     * @return void
     */
    public function list() {
        date_default_timezone_set("Europe/Samara");

        return view('course.list', [
            'courses' => Course::all()
        ]);
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

        $currentDate = new DateTime(date( "d.m.Y H:i:s", strtotime("now")));
        $endEntryDate = new DateTime(date( "d.m.Y H:i:s", strtotime($course->end_entry_date)));
        $diffDateBool = $currentDate <= $endEntryDate;

        $comments = DB::table('course_comments')
                            ->join('users', 'course_comments.user_id', '=', 'users.id')
                            ->join('user_infos', 'course_comments.user_id', '=', 'user_infos.user_id')
                            ->select('course_comments.*', 'users.login as user_login', 'user_infos.name as user_name', 'user_infos.photo as user_photo', 'user_infos.rate as user_rate')
                            ->where('course_comments.course_id', $course->id)
                            ->orderBy('date', 'desc')
                            ->get();

        return view('course.show', [
            'course' => $course,
            'date_diff' => $diffDateBool,
            'comments' => $comments
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
            'description' => 'required|max:255'
        ], $messages);
        if ($validator->fails()) {
            return redirect('course/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $startDate = $request->start_date . ' ' . $request->start_time;
        $endDate = $request->end_date . ' ' . $request->end_time;
        $endEntryDate = $request->end_entry_date . ' ' . $request->end_entry_time;

        $startDateTime = new DateTime(date( "d.m.Y H:i:s", strtotime($startDate)));
        $endEntryDateTime = new DateTime(date( "d.m.Y H:i:s", strtotime($endEntryDate)));

        $endEntryDateTimeString = $startDateTime
                                ->diff($endEntryDateTime)
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
            'course_id' => 'required|unique:course_records',
            'user_id' => 'unique:course_records,course_id,'.$course->id,
            'date' => 'required|before:' . $course->end_entry_date
        ]);

        $record = null;

        if (! $validator->fails()) {
            $record = CourseRecord::create([
                'course_id' => $course->id,
                'user_id' => Auth::user()->id,
                'date' => $request->date
            ]);
            event(new CourseSubscribed($record));
        }
        
        return redirect('course/' . $course->id);
    }
    /**
     * Обновление данных курса в БД
     *
     * @param int $id
     * @param Request $request
     * @return void
     */
    public function update($id, Request $request) {

    }
    /**
     * Удаление курса
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {
        
    }
}
