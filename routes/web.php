<?php

use Illuminate\Support\Facades\Route;

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
    return view('web_front.home');
});
Route::get('/login', function () {
    return redirect('/student');
});
Route::get('contact', function () {
    return view('web_front.contact');
});
/*Route::get('feedback', function () {
    return view('feedbacks.create');
});*/
Route::get('feedback/create','FeedbackController@create')->name('feedback/create');
Route::post('feedbacks.store','FeedbackController@store')->name('feedbacks.store');
/*Auth::routes(['verify' => true]);*/


Route::group(['middleware' => ['auth:admin']], function () {

	Route::get('feedbacks/index','FeedbackController@index')->name('feedbacks.index');
	Route::resource('boards', 'BoardController');
	Route::resource('genders', 'GenderController');
	Route::resource('categories', 'CategoryController');
	Route::resource('courses', 'CourseController');
	Route::resource('feesheads', 'FeesHeadController');
	Route::resource('religions', 'ReligionController');
	Route::resource('admin_students', 'adminStudentController');
	Route::resource('newfees', 'NewFeeController');
	Route::get('getSMSBalance','adminStudentController@getSMSBalance')->name('getSMSBalance');
	Route::get('displayStudentApplication/{application}','adminStudentController@showStudentApplication')->name('displayStudentApplication');
	Route::get('/myadminstorage/{filename}', function ($filename)
	{

	    $path = storage_path('app/student_files/'.$filename);

	    if (!File::exists($path)) {
	        abort(404);
	    }

	    $file = File::get($path);
	    $type=File::extension($path);
	    
	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
	})->name('myadminstorage');	

});/* End Of Route::group admin*/

Route::group(['middleware' => ['auth:student']], function () {
	Route::post('ApplicationStore','AdmisssionApplicationController@store')->name('ApplicationStore');
	Route::post('ApplicationUpdateAgree','AdmisssionApplicationController@UpdateAgree')->name('ApplicationUpdateAgree');
	Route::post('ApplicationUpdatePersonal','AdmisssionApplicationController@UpdatePersonal')->name('ApplicationUpdatePersonal');
	Route::post('ApplicationUpdateProfessional','AdmisssionApplicationController@UpdateProfessional')->name('ApplicationUpdateProfessional');
	Route::post('ApplicationUpdateUpload','AdmisssionApplicationController@UpdateUpload')->name('ApplicationUpdateUpload');
	Route::post('ApplicationUpdateSubjects','AdmisssionApplicationController@UpdateSubjects')->name('ApplicationUpdateSubjects');
	Route::post('generateOTP','AdmisssionApplicationController@generateOTP')->name('generateOTP');
	Route::post('verifyOTP','AdmisssionApplicationController@verifyOTP')->name('verifyOTP');
	Route::get('resendOTP','AdmisssionApplicationController@resendOTP')->name('resendOTP');

	Route::get('ApplicationUpdateEdit','AdmisssionApplicationController@UpdateEdit')->name('ApplicationUpdateEdit');
	Route::get('displayApplication/{application}','AdmisssionApplicationController@show')->name('displayApplication');

	Route::get('/mystorage/{filename}', function ($filename)
	{

	    $path = storage_path('app/student_files/'.$filename);

	    if (!File::exists($path)) {
	        abort(404);
	    }

	    $file = File::get($path);
	    $type=File::extension($path);
	    
	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
	})->name('mystorage');	
});/* End Of Route::group student*/

	Route::get('/anotherstorage/{filename}', function ($filename)
	{

	    $path = storage_path('app/student_files/'.$filename);

	    if (!File::exists($path)) {
	        abort(404);
	    }

	    $file = File::get($path);
	    $type=File::extension($path);
	    
	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
	})->name('anotherstorage');	