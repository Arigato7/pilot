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
Route::get('/organizations', 'EducationOrganizationController@list')->name('organizations');
Route::get('/organization/create', 'EducationOrganizationController@create')->name('organizations.create');
Route::post('/organization/add', 'EducationOrganizationController@store')->name('organizations.store');
Route::get('/organization/{organization}', 'EducationOrganizationController@show')->name('organizations.show');
Route::get('/organization/{organization}/edit', 'EducationOrganizationController@edit')->name('organizations.edit');
Route::post('/organization/{organization}/save', 'EducationOrganizationController@update')->name('organizations.update');
Route::post('/organization/{organization}/del', 'EducationOrganizationController@delete')->name('organizations.delete');
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
Route::get('/material/create', 'MaterialController@create')->name('materials.create');
Route::post('/material/save', 'MaterialController@store')->name('materials.store');
Route::get('/material/{material}', 'MaterialController@show')->name('materials.show');
Route::get('/material/{material}/edit', 'MaterialController@edit')->name('materials.edit');
Route::post('/material/{material}/save', 'MaterialController@update')->name('materials.update');
Route::get('/material/{material}/download', 'MaterialController@download')->name('materials.download');
Route::post('/material/{material}/delete/temp', 'MaterialController@deleteTemp')->name('materials.delete.temp');
Route::post('/material/{material}/delete/forever', 'MaterialController@deleteForever')->name('materials.delete.forever');
Route::post('/material/{material}/restore', 'MaterialController@restore')->name('materials.restore');
/**
 * Маршруты для фильрации материалов
 */
Route::get('/material/filter/type/{type}', 'MaterialController@typeMaterial')->name('materials.filter.type');
Route::get('/material/filter/user/{user}', 'MaterialController@usersMaterials')->name('materials.filter.user');
Route::get('/material/filter/subject/{subject}', 'MaterialController@subjectMaterials')->name('materials.filter.subject');
Route::get('/material/filter/specialty/{specialty}', 'MaterialController@specialtyMaterials')->name('materials.filter.specialty');
/**
 * Маршруты для поиска материалов
 */
Route::get('/material/search/{material}', 'MaterialSearchController@search');
Route::post('/material/find', 'MaterialSearchController@find');
/**
 * Маршруты для комментариев к материалам
 */
Route::post('/material/{material}/comment', 'MaterialCommentController@store')->name('materials.comment.store');
Route::post('/material/{material}/comment/{id}/delete', 'MaterialCommentController@delete')->name('materials.comment.delete');
Route::get('/material/{material}/comment/delete', 'MaterialCommentController@deleteAll')->name('materials.comment.delete.all');
/**
 * Маршруты для типов материалов
 */
Route::get('/material-types', 'MaterialTypeController@list')->name('materials.types');
/**
 * Маршруты для жалоб к материалам
 */
Route::get('/complaints', 'MaterialComplaintController@index')->name('materials.complaints');
Route::get('/complaint/create/{material}', 'MaterialComplaintController@create')->name('materials.complaint.create');
Route::post('/complaint/save', 'MaterialComplaintController@store')->name('materials.complaint.store');
Route::post('/complaint/{complaint}/delete', 'MaterialComplaintController@delete')->name('materials.complaint.delete');
/**
 * Маршруты для новостей
 */
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/create', 'NewsController@create')->name('news.create')->middleware('check.admin');
Route::post('/news/store', 'NewsController@store')->name('news.store')->middleware('check.admin');
Route::get('/news/{news}', 'NewsController@show')->name('news.show');
/**
 * Маршруты для курсов
 */
Route::get('/courses', 'CourseController@list')->name('courses');
Route::get('/course/create', 'CourseController@create')->name('courses.create');
Route::post('/course/save', 'CourseController@store')->name('courses.store');
Route::get('/course/{course}', 'CourseController@show')->name('courses.show');
Route::get('/course/{course}/edit', 'CourseController@edit')->name('courses.edit');
Route::post('/course/{course}/update', 'CourseController@update')->name('courses.update');
Route::post('/course/{course}/delete', 'CourseController@delete')->name('courses.delete');
/**
 * Маршруты для комментариев к курсам
 */
Route::post('/course/{course}/comment', 'CourseCommentController@store')->name('courses.comment.store');
/**
 * Маршруты для подписки/отписки на/от курс(а)
 */
Route::post('/course/{course}/entry', 'CourseController@enrollment')->name('courses.enroll');
Route::post('/course/{course}/cancel', 'CourseController@cancellation')->name('courses.cancel');
/**
 * Маршруты для типов курсов
 */
Route::get('/course-types', 'CourseTypeController@list')->name('courses.types');
Route::post('/course-type/store', 'CourseTypeController@store')->name('courses.types.store');
Route::post('/course-type/{type}/delete', 'CourseTypeController@delete')->name('courses.types.delete');
/**
 * Маршруты фалов курсов
 */
Route::get('/course-file/{file}/download', 'CourseFileController@download')->name('corses.files.download');
Route::post('/course-file/upload', 'CourseFileController@upload');
/**
 * Маршруты для дистанционного обучения
 */
Route::get('/practical-works', 'PracticalWorkController@list')->name('practicals');
Route::get('/practical-work/create', 'PracticalWorkController@create')->name('practicals.create');
Route::post('/practical-work/save', 'PracticalWorkController@store')->name('practicals.store');
Route::get('/practical-work/{practical}', 'PracticalWorkController@show')->name('practicals.show');
/**
 * Маршруты для заявок на регистрацию
 */
Route::post('/register-application/store', 'RegisterApplicationController@store')->name('application.store');
Route::post('/register-application/{application}/accept', 'RegisterApplicationController@accept')->name('application.accept')->middleware('check.admin');
Route::post('/register-application/{application}/delete', 'RegisterApplicationController@delete')->name('application.delete')->middleware('check.admin');
/**
 * Маршруты для пользователей
 */
Route::get('/user/{user}', 'UserController@show')->name('users.show');
Route::get('/user/{user}/settings', 'UserController@edit')->name('users.edit');
Route::get('/user/{user}/props', 'UserController@editProps')->name('users.props.edit');
Route::post('/user/{user}/change', 'UserController@update')->name('users.update');
Route::post('/user/{user}/save-props', 'UserController@saveProps')->name('users.props.update');
Route::get('/users', 'UserController@index')->name('users')->middleware('check.admin');
