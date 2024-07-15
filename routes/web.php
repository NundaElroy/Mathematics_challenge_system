<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

// Authenticated user routes
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class, ['except' => ['show']]);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('{page}', [PageController::class, 'index'])->name('page.index');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/upload-schools', [AdminController::class, 'showUploadSchoolsForm'])->name('admin.upload.schools');
    Route::post('/admin/upload-schools', [AdminController::class, 'uploadSchools']);
    Route::get('/admin/upload-questions', [AdminController::class, 'showUploadQuestionsForm'])->name('admin.upload.questions');
    Route::post('/admin/upload-questions', [AdminController::class, 'uploadQuestions']);
    Route::get('/admin/set-competition', [AdminController::class, 'showSetCompetitionForm'])->name('admin.set.competition');
    Route::post('/admin/set-competition', [AdminController::class, 'setCompetition']);
});

// Question and Answer routes
Route::resource('questions', QuestionController::class)->except(['show']);
Route::post('questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');

// Excel upload routes
Route::get('/upload', function () {
    return view('upload');
})->name('upload.form');
Route::post('/upload', [ExcelController::class, 'uploadExcel'])->name('upload.excel');

// School routes
Route::resource('schools', SchoolController::class);
