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

Route::get('/organizations', 'EducationOrganizationController@list')->name('educationOrganizations');
Route::get('/organization/create', 'EducationOrganizationController@create')->name('createOrganization');
Route::post('/organization/add', 'EducationOrganizationController@store')->name('addOrganization');
Route::get('/organization/{organization}', 'EducationOrganizationController@show');
Route::get('/organization/{organization}/edit', 'EducationOrganizationController@edit');
Route::post('/organization/{organization}/save', 'EducationOrganizationController@update');
Route::post('/organization/{organization}/del', 'EducationOrganizationController@delete');

Route::get('/specialties', 'SpecialtyController@list')->name('specialties');

Route::get('/materials', 'MaterialController@index')->name('materials');
Route::get('/material/create', 'MaterialController@create')->name('materialCreate');
Route::post('/material/save', 'MaterialController@store')->name('materialSave');
Route::get('/material/{material}', 'MaterialController@show');
Route::get('/material/{material}/edit', 'MaterialController@edit');
Route::post('/material/{material}/save', 'MaterialController@update');
Route::get('/material/{material}/download', 'MaterialController@download');

Route::post('/material/{material}/delete/{way}', 'MaterialController@delete');
Route::post('/material/{material}/restore', 'MaterialController@restore');

Route::get('/material/filter/type/{type}', 'MaterialController@typeMaterial');
Route::get('/material/filter/user/{user}', 'MaterialController@usersMaterials');
Route::get('/material/filter/subject/{subject}', 'MaterialController@subjectMaterials');
Route::get('/material/filter/specialty/{specialty}', 'MaterialController@specialtyMaterials');

Route::get('/material/search/{material}', 'MaterialSearchController@search');
Route::post('/material/find', 'MaterialSearchController@find');

Route::post('/material/{material}/comment', 'MaterialCommentController@store');
Route::post('/material/{material}/comment/{id}/delete', 'MaterialCommentController@delete');
Route::get('/material/{material}/comment/delete', 'MaterialCommentController@deleteAll');

Route::get('/complaints', 'MaterialComplaintController@index')->name('materialComplaints');
Route::get('/complaint/create/{material}', 'MaterialComplaintController@create');
Route::post('/complaint/save', 'MaterialComplaintController@store')->name('saveMaterialComplaints');
Route::post('/complaint/{complaint}/delete', 'MaterialComplaintController@delete');

Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/create', 'NewsController@create')->name('newsCreate');
Route::get('/news/{news}', 'NewsController@show');

Route::get('/courses', 'CourseController@list')->name('courses');
Route::get('/course/create', 'CourseController@create')->name('courseCreate');

Route::get('/user/{user}', 'UserController@show');
Route::get('/user/{user}/settings', 'UserController@edit');
Route::post('/user/{user}/change', 'UserController@update');
Route::get('/users', 'UserController@index')->name('users');
