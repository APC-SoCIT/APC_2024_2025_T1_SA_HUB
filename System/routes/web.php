<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SaDashboardController;
use App\Http\Controllers\SaManagerDashboardController;
use App\Http\Controllers\OfficeAdminDashboardController;
use App\Http\Controllers\GuidanceController;
//use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Login Route
Route::get('/', [Controller::class, 'index'])->name('landing');

// Route::get('/', [Controller::class, 'home'])->name('landing');
// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

//Logout Route
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

//Student Assistant Routes
Route::get('/student_assistant/dashboard', [SaDashboardController::class, 'index'])->name('sa.dashboard');
Route::post('/student_assistant/{task}/accept', [SaDashboardController::class, 'acceptTask'])->name('sa.accept');
Route::post('/student_assistant/timein', [SaDashboardController::class, 'addTimeIn'])->name('sa.timein');
Route::post('/student_assistant/timeout', [SaDashboardController::class, 'addTimeOut'])->name('sa.timeout');
Route::get('/student_assistant/profile', [SaDashboardController::class, 'profile'])->name('sa.profile');

//Student Assistant Manager Routes
Route::get('/sa_manager/dashboard/on-going', [SAManagerDashboardController::class, 'onGoing'])->name('sa.manager.dashboard.ongoing');
Route::get('/sa_manager/dashboard/done', [SAManagerDashboardController::class, 'finished'])->name('sa.manager.dashboard.done');
Route::get('/sa_manager/probation', [SAManagerDashboardController::class, 'probation'])->name('sa.manager.probation');
Route::get('/sa_manager/probation/add', [SAManagerDashboardController::class, 'addProbation'])->name('sa.manager.probation.add');
Route::post('/sa_manager/probation/store', [SAManagerDashboardController::class, 'storeProbation'])->name('sa.manager.probation.store');
Route::get('/sa_manager/{task_id}/{list}', [SAManagerDashboardController::class,'viewSaList'])->name('sa.manager.saList');
Route::get('/sa_manager/{taskId}/sa_timein_approve', [SAManagerDashboardController::class,'acceptTimeIn'])->name('sa.manager.saListTimeInApprove');
Route::get('/sa_manager/{taskId}/sa_timeout_approve', [SAManagerDashboardController::class,'acceptTimeOut'])->name('sa.manager.saListTimeOutApprove');
Route::get('/sa_manager/{taskId}/sa_list_done', [SAManagerDashboardController::class,'viewSaListDone'])->name('sa.manager.saListDone');
Route::put('/sa_manager/add_hours', [SAManagerDashboardController::class, 'editHours'])->name('sa.manager.addHours');
Route::get('/sa_manager/revoke', [SAManagerDashboardController::class, 'revoke'])->name('sa.manager.revoke');
Route::post('/sa_manager/scholarship/{saProfile}/probe', [SAManagerDashboardController::class, 'setToProbation'])->name('sa.manager.scholarship.probe');
Route::post('/sa_manager/scholarship/{saProfile}/revoke', [SAManagerDashboardController::class, 'setToRevoke'])->name('sa.manager.scholarship.revoke');


//Office Admin Routes
//Route::get('/office_admin/dashboard', [OfficeAdminDashboardController::class, 'index'])->name('office.admin.dashboard');
//Route::get('/office_admin/sa-report-completed', [OfficeAdminDashboardController::class, 'saReportCompleted'])->name('office.sa.completed');
Route::get('/office_admin/dashboard', [OfficeAdminDashboardController::class, 'dashboard'])->name('office.dashboard');
Route::get('/office_admin/dashboard/task_view', [OfficeAdminDashboardController::class, 'taskView'])->name('office.admin.taskview.dashboard');
Route::get('/office_admin/history', [OfficeAdminDashboardController::class, 'history'])->name('office.history');
// Route::put('/office_admin/{task}/update', [OfficeAdminDashboardController::class, 'update'])->name('office.update');
Route::post('/office_admin/add', [OfficeAdminDashboardController::class, 'store'])->name('office.add');
Route::get('/office_admin/add_task', [OfficeAdminDashboardController::class, 'addtask'])->name('office.add.task');
// Route::post('/office_admin/add', [OfficeAdminDashboardController::class, 'store'])->name('office.add');
Route::put('/office_admin/{task}', [OfficeAdminDashboardController::class, 'update'])->name('office.update');
Route::get('/office_admin/{task}/edit', [OfficeAdminDashboardController::class, 'edit'])->name('office.edit');
Route::post('/office_admin/{task}/delete', [OfficeAdminDashboardController::class, 'delete'])->name('office.delete');
Route::post('/office_admin/{task}/cancel', [OfficeAdminDashboardController::class, 'cancel'])->name('office.cancel');
Route::get('/office_admin/{taskId}/sa_list', [OfficeAdminDashboardController::class,'taskSaList'])->name('office.saList');
Route::put('/office_admin/feedback', [OfficeAdminDashboardController::class, 'addFeedback'])->name('office.feedback');


//Reports
Route::get('/sa-records/{status?}', [OfficeAdminDashboardController::class, 'saReport'])->name('report.saReport');
Route::get('/office-report', [OfficeAdminDashboardController::class, 'officeReport'])->name('report.officeReport');

//Route::resource('tasks', TaskController::class);
// Guidance Routes
Route::get('/guidance_office/dashboard', [GuidanceController::class, 'dashboard'])->name('guidance.dashboard');
Route::get('/guidance_office/probation', [GuidanceController::class, 'probation'])->name('guidance.probation');
Route::get('/guidance_office/scholarship', [GuidanceController::class, 'scholarship'])->name('guidance.scholarship');
Route::post('/guidance_office/scholarship/{saProfile}/probe', [GuidanceController::class, 'setToProbation'])->name('guidance.scholarship.probe');
Route::post('/guidance_office/scholarship/{saProfile}/revoke', [GuidanceController::class, 'setToRevoke'])->name('guidance.scholarship.revoke');

});

Auth::routes(['verify' => true]);
// routes/web.php
Route::get('/{id}/login', [LoginController::class, 'showLoginForm'])->name('login.page');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
