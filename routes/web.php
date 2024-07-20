<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;


// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Authenticated user routes
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class, ['except' => ['show']]);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/{page}', [PageController::class, 'index'])->name('page.index');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () { Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/questions/upload', [QuestionController::class, 'showUploadForm'])->name('pages.questions');
Route::post('/admin/questions/upload', [QuestionController::class, 'uploadQuestions'])->name('questiones.upload');

});


// School routes
Route::resource('/schools', SchoolController::class);

Route::resource('/challenges', ChallengeController::class);
 
//new routes to handle importing of excel file
Route::post('/challenges/upload-questions', [ChallengeController::class, 'uploadQuestions'])->name('questions.upload');
Route::post('/challenges/upload-answers', [ChallengeController::class, 'uploadAnswers'])->name('answers.upload');


Route::get('/questions/upload', [QuestionController::class, 'showUploadForm'])->name('questions.questions-form');
Route::post('/questions/upload', [QuestionController::class, 'uploadQuestions'])->name('questions.questions');

//new dashboard controller
// routes/web.php



Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboards.index');
