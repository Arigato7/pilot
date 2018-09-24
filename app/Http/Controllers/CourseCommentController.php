<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Course;
use Pilot\CourseComment;
use Illuminate\Http\Request;

class CourseCommentController extends Controller
{
    /**
     * Запись комментария к курсу в БД
     *
     * @param Request $request
     * @param int $course_id
     * @return void
     */
    public function store(Request $request, $course_id) {

        $course = Course::findOrFail($course_id);
        $messages = [
            'description.required' => 'Введите комментарий!',
            'description.max' => 'Комментарий не может превышать длину в 2000 символов!'
        ];
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:2000',
            'user_id' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect('course/' . $course->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        CourseComment::create([
            'course_id' => $course->id,
            'user_id' => $request->user_id,
            'description' => $request->description,
        ]);

        return redirect('course/' . $course->id);
    }
    /**
     * Удаление комментария к курсу из БД
     *
     * @param int $id
     * @return void
     */
    public function delete($id) {

    }
    /**
     * Удаление всех комментариев к курсу из БД
     *
     * @param int $course_id
     * @return void
     */
    public function deleteAll($course_id) {

    }
}
