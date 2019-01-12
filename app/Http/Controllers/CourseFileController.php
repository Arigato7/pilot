<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Course;
use Pilot\CourseFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseFileController extends Controller
{
    /* public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.teacher');
    } */
    /**
     * Undocumented function
     *
     * @param [type] $directory
     * @return void
     */
    protected function createCourseDirectory($directory) {
        if (! Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
    }
    /**
     * Undocumented function
     *
     * @param [type] $fileName
     * @return void
     */
    protected function courseFileName($fileName) {
        return 'C_' . substr(md5(date('d_m_o_His')), 0, 8)
                . '_'
                . pathinfo($fileName, PATHINFO_FILENAME)
                . '.'
                . pathinfo($fileName, PATHINFO_EXTENSION);
    }
    /**
     * Undocumented function
     *
     * @param [type] $path
     * @return void
     */
    protected function deleteFile($path) {
        return Storage::disk('local')->delete($path);
    }

    protected function deleteAllFiles($directory) {
        return Storage::disk('local')->deleteDirectory($directory);
    }
    /**
     * Undocumented function
     *
     * @param [type] $file
     * @return void
     */
    public static function getFileSize($path) {
        return Storage::size($path);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function upload(Request $request) {
        $this->createCourseDirectory("/public/courses/" . $request->course_id);

        if ($request->hasFile('course_file')) {
            $file = $request->file('course_file');
            $fileName = $file->getClientOriginalName();
            $extensions = [
                'doc','docx','xls','xlsx','ppt','pptx','pdf','txt','zip','rar','7z','png','jpg'
            ];
            if (in_array(pathinfo($fileName, PATHINFO_EXTENSION), $extensions)) {
                
                $path = $file->storeAs('/public/courses/' 
                            . $request->course_id, $this->courseFileName($fileName));
    
                $courseFile = new CourseFile;
    
                $courseFile->course_id = $request->course_id;
                $courseFile->alias = $fileName;
                $courseFile->fullname = $this->courseFileName($fileName);
                $courseFile->type = pathinfo($fileName, PATHINFO_EXTENSION);
    
                $courseFile->save();
    
                return $courseFile;
            }
        }
        return false;
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id) {
        $file = CourseFile::findOrFail($id);
        if ($this->deleteFile('public/courses/' . $file->course_id . '/' . $file->fullname)) {
            $file->delete();
        }
    }

    public function deleteAll($course_id) {
        $course = Course::findOrFail($course_id);
        $this->deleteAllFiles('public/courses/' . $course->id);
        return redirect()->route('courses.show', [
            'id' => $course->id
        ]);
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function download($id) {
        $file = CourseFile::findOrFail($id);
        $pathToFile = storage_path('app/public/courses/' . $file->course_id . '/' . $file->fullname);
        return response()->download($pathToFile);
    }
}
