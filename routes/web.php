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
    return view('welcome');
});

Auth::routes();
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/upload-schools', [AdminController::class, 'showUploadSchoolsForm'])->name('admin.upload.schools');
    Route::post('/admin/upload-schools', [AdminController::class, 'uploadSchools']);
    Route::get('/admin/upload-questions', [AdminController::class, 'showUploadQuestionsForm'])->name('admin.upload.questions');
    Route::post('/admin/upload-questions', [AdminController::class, 'uploadQuestions']);
    Route::get('/admin/set-competition', [AdminController::class, 'showSetCompetitionForm'])->name('admin.set.competition');
    Route::post('/admin/set-competition', [AdminController::class, 'setCompetition']);
});

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

Route::resource('questions', QuestionController::class);
Route::post('questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');


Route::resource('questions', QuestionController::class)->except(['show']);
Route::get('/questAnswer', [PageController::class, 'index'])->name('questAnswer');
Route::get('/questions/index', [QuestionController::class, 'index'])->name('questions.index');

use App\Http\Controllers\ExcelController;

Route::get('/upload', function () {
    return view('upload');
})->name('upload.form');

Route::post('/upload', [ExcelController::class, 'uploadExcel'])->name('upload.excel');


use App\Http\Controllers\SchoolController;

Route::resource('schools', SchoolController::class);


Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('/upload-schools', [SchoolController::class, 'showUploadForm'])->name('admin.upload.schools');
    Route::post('/upload-schools', [SchoolController::class, 'upload'])->name('admin.upload.schools');
});

use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});



