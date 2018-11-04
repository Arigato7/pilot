<?php

namespace Pilot\Http\Controllers\Api;

use Pilot\Material;
use Illuminate\Http\Request;
use Pilot\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function materialSearch(Request $request)
    {
        // Определим сообщение, которое будет отображаться, если ничего не найдено 
        // или поисковая строка пуста
        $error = ['error' => 'Ничего не найдено, попробуйте ввести другие ключевые слова.'];

        // Удостоверимся, что поисковая строка есть
        if($request->has('materialName')) {

            // Используем синтаксис Laravel Scout для поиска по таблице products.
            $materials = Material::search($request->get('materialName'))->get();

            // Если есть результат есть, вернем его, если нет  - вернем сообщение об ошибке.
            return $materials->count() ? $materials : $error;

        }

        // Вернем сообщение об ошибке, если нет поискового запроса
        return $error;
    }
}
