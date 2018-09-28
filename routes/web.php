<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/**
 * Маршруты для образовательных организаций
 */
Route::get('/organizations', 'EducationOrganizationController@list')->name('educationOrganizations');
Route::get('/organization/create', 'EducationOrganizationController@create')->name('createOrganization');
Route::post('/organization/add', 'EducationOrganizationController@store')->name('addOrganization');
Route::get('/organization/{organization}', 'EducationOrganizationController@show');
Route::get('/organization/{organization}/edit', 'EducationOrganizationController@edit');
Route::post('/organization/{organization}/save', 'EducationOrganizationController@update');
Route::post('/organization/{organization}/del', 'EducationOrganizationController@delete');
/**
 * Маршруты специальностей
 */
Route::get('/specialties', 'SpecialtyController@list')->name('specialties');
/**
 * Маршруты для дисциплин
 */
Route::get('/subjects', 'SubjectController@list')->name('subjects');
/**
 * Маршруты материалов
 */
Route::get('/materials', 'MaterialController@index')->name('materials');
Route::get('/material/create', 'MaterialController@create')->name('materialCreate');
Route::post('/material/save', 'MaterialController@store')->name('materialSave');
Route::get('/material/{material}', 'MaterialController@show');
Route::get('/material/{material}/edit', 'MaterialController@edit');
Route::post('/material/{material}/save', 'MaterialController@update');
Route::get('/material/{material}/download', 'MaterialController@download');
Route::post('/material/{material}/delete/temp', 'MaterialController@deleteTemp');
Route::post('/material/{material}/delete/forever', 'MaterialController@deleteForever');
Route::post('/material/{material}/restore', 'MaterialController@restore');
/**
 * Маршруты для фильрации материалов
 */
Route::get('/material/filter/type/{type}', 'MaterialController@typeMaterial');
Route::get('/material/filter/user/{user}', 'MaterialController@usersMaterials');
Route::get('/material/filter/subject/{subject}', 'MaterialController@subjectMaterials');
Route::get('/material/filter/specialty/{specialty}', 'MaterialController@specialtyMaterials');
/**
 * Маршруты для поиска материалов
 */
Route::get('/material/search/{material}', 'MaterialSearchController@search');
Route::post('/material/find', 'MaterialSearchController@find');
/**
 * Маршруты для комментариев к материалам
 */
Route::post('/material/{material}/comment', 'MaterialCommentController@store');
Route::post('/material/{material}/comment/{id}/delete', 'MaterialCommentController@delete');
Route::get('/material/{material}/comment/delete', 'MaterialCommentController@deleteAll');
/**
 * Маршруты для типов материалов
 */
Route::get('/material-types', 'MaterialTypeController@list')->name('materialTypes');
/**
 * Маршруты для жалоб к материалам
 */
Route::get('/complaints', 'MaterialComplaintController@index')->name('materialComplaints');
Route::get('/complaint/create/{material}', 'MaterialComplaintController@create');
Route::post('/complaint/save', 'MaterialComplaintController@store')->name('saveMaterialComplaints');
Route::post('/complaint/{complaint}/delete', 'MaterialComplaintController@delete');
/**
 * Маршруты для новостей
 */
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/create', 'NewsController@create')->name('newsCreate');
Route::get('/news/{news}', 'NewsController@show');
/**
 * Маршруты для курсов
 */
Route::get('/courses', 'CourseController@list')->name('courses');
Route::get('/course/create', 'CourseController@create')->name('courseCreate');
Route::get('/course/{course}', 'CourseController@show');
Route::post('/course/save', 'CourseController@store')->name('courseStore');
/**
 * Маршруты для комментариев к курсам
 */
Route::post('/course/{course}/comment', 'CourseCommentController@store');
/**
 * Маршрут для записи на курс
 */
Route::post('/course/{course}/entry', 'CourseController@enrollment');
/**
 * Маршруты для дистанционного обучения
 */
Route::get('/practical-works', 'PracticalWorkController@list')->name('practicalWork');
Route::get('/practical-work/create', 'PracticalWorkController@create')->name('practicalWorkCreate');

Route::post('/practical-work/save', 'PracticalWorkController@store')->name('practicalWorkStore');
/**
 * Маршруты для пользователей
 */
Route::get('/user/{user}', 'UserController@show');
Route::get('/user/{user}/settings', 'UserController@edit');
Route::post('/user/{user}/change', 'UserController@update');
Route::get('/users', 'UserController@index')->name('users');
