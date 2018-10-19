<?php

namespace Pilot\Http\Controllers;

use Validator;
use Pilot\Material;
use Pilot\MaterialComment;
use Illuminate\Http\Request;
use Pilot\Events\MaterialRated;
use Illuminate\Support\Facades\DB;

class MaterialCommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('check.teacher');
    }
    /**
     * Запись комментария к материалу в БД
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        // Проверка данных на правильность
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:2000',
            'review' => 'required'
        ]);
        // Если данные не прошли проверку, то перенаправляем пользователя
        if ($validator->fails()) {
            return redirect('material/' . $request->material_id)
                        ->withErrors($validator)
                        ->withInput();
        }
        // Создание записи в таблице material_comments
        MaterialComment::create([
            'material_id' => $request->material_id,
            'user_id' => $request->user_id,
            'description' => $request->description,
            'review' => $request->review
        ]);
        // Инициация события "Материал оценен" 
        event(new MaterialRated(Material::findOrFail($request->material_id)));

        return redirect('material/' . $request->material_id);
    }
    /**
     * Удаление комментария к материалу
     *
     * @param int $material_id
     * @param int $id
     * @return void
     */
    public function delete($material_id, $id) {
        $comment = MaterialComment::findOrFail($id);

        DB::table('material_comments')
            ->where('id', $comment->id)
            ->delete();

        return redirect('material/' . $material_id);
    }
    /**
     * Удаление всех комментариев к материалу
     *
     * @param int $material_id
     * @return void
     */
    public function deleteAll($material_id) {
        $material = Material::findOrFail($material_id);

        DB::table('material_comments')
            ->where('material_id', $material->id)
            ->delete();

        return redirect('material/' . $material->id);
    }
}
