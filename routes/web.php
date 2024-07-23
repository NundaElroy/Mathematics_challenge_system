<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportScheduleController;





// Home route
Route::get('/', function () {
    return view('welcome');
});

//route for guest view
Route::get('/guest-welcome', function () {
    return view('guest_welcome');
})->name('guest.welcome');

Route::get('/analytics', 'AnalyticsController@showAnalytics')->name('analytics');



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
    // School routes
    Route::resource('/schools', SchoolController::class);
    //challenge route
    Route::resource('/challenges', ChallengeController::class);
    //new routes to handle importing of excel file
    Route::post('/challenges/upload-questions', [ChallengeController::class, 'uploadQuestions'])->name('questions.upload');
    Route::post('/challenges/upload-answers', [ChallengeController::class, 'uploadAnswers'])->name('answers.upload');

    // Route::get('/test-send-reports/{challengeId}/{participantid}', [PdfController::class, 'sendReports']);
    //route for handling report scheduling
    Route::get('/report/view', [QuestionController::class, 'display'])->name('reports.scheduleshow');
    Route::get('/reports/form', [QuestionController::class, 'showForm'])->name('report.scheduleviewform');

    Route::post('/report-schedules/create', [QuestionController::class, 'store'])->name('report.scheduleview');
    Route::get('/report-schedules/{reportid}/edit', [QuestionController::class, 'edit'])->name('report.scheduleedit');
    Route::put('/report-schedules/{reportid}', [QuestionController::class, 'update'])->name('report.scheduleupdate');
    Route::delete('/report-schedules/{reportSchedule}', [QuestionController::class, 'destroy'])->name('report.scheduledestroy');

    
    // })->name('report.scheduleview');
    // Route::post('/schedule-report-store', [ReportScheduleController::class, 'store'])->name('report.schedule');
    // Route::resource('report-schedules', ReportScheduleController::class);
    // Route::get('/report-schedules/create', [ReportScheduleController::class, 'store'])->name('reports.scheduleview');
    Route::get('/report-schedules', [ReportScheduleController::class, 'display'])->name('report.scheduleshow');
    // Route::get('/report-schedules/{reportid}/edit', [ReportScheduleController::class, 'edit'])->name('report.scheduleedit');
    // Route::put('/report-schedules/{reportid}', [ReportScheduleController::class, 'update'])->name('report.scheduleupdate');
    // Route::delete('/report-schedules/{reportSchedule}', [ReportScheduleController::class, 'destroy'])->name('report.scheduledestroy');
    Route::get('/scheduler', function () {
        return  "hello world";
    });

    


});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () { Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/questions/upload', [QuestionController::class, 'showUploadForm'])->name('pages.questions');
Route::post('/admin/questions/upload', [QuestionController::class, 'uploadQuestions'])->name('questiones.upload');

});


 



//new dashboard controller
// routes/web.php

// Route::get('/test-send-reports/{challengeId}/{participantid}', [PdfController::class, 'sendReports']);

// Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboards.index');


//report routes


