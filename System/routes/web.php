<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SaDashboardController;
use App\Http\Controllers\SaManagerDashboardController;
use App\Http\Controllers\OfficeAdminDashboardController;
//use App\Http\Controllers\TaskController;

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
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

//Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
Route::get('/sa_manager/{taskId}/sa_list', [SAManagerDashboardController::class,'viewSaList'])->name('sa.manager.saList');
Route::get('/sa_manager/{taskId}/sa_timein_approve', [SAManagerDashboardController::class,'acceptTimeIn'])->name('sa.manager.saListTimeInApprove');
Route::get('/sa_manager/{taskId}/sa_timeout_approve', [SAManagerDashboardController::class,'acceptTimeOut'])->name('sa.manager.saListTimeOutApprove');
Route::get('/sa_manager/{taskId}/sa_list_done', [SAManagerDashboardController::class,'viewSaListDone'])->name('sa.manager.saListDone');
Route::put('/sa_manager/add_hours', [SAManagerDashboardController::class, 'editHours'])->name('sa.manager.addHours');

//Office Admin Routes
//Route::get('/office_admin/dashboard', [OfficeAdminDashboardController::class, 'index'])->name('office.admin.dashboard');
//Route::get('/office_admin/sa-report-completed', [OfficeAdminDashboardController::class, 'saReportCompleted'])->name('office.sa.completed');
Route::get('/office_admin/dashboard/', [OfficeAdminDashboardController::class, 'dashboard'])->name('office.dashboard');
Route::get('/office_admin/dashboard/task_view', [OfficeAdminDashboardController::class, 'taskView'])->name('office.admin.taskview.dashboard');
Route::put('/office_admin/{task}/edit', [OfficeAdminDashboardController::class, 'update'])->name('office.edit');
Route::post('/office_admin/add', [OfficeAdminDashboardController::class, 'store'])->name('office.add');
Route::get('/office_admin/add_task', [OfficeAdminDashboardController::class, 'addtask'])->name('office.add.task');
Route::post('/office_admin/{task}/delete', [OfficeAdminDashboardController::class, 'delete'])->name('office.delete');
Route::post('/office_admin/{task}/cancel', [OfficeAdminDashboardController::class, 'cancel'])->name('office.cancel');
Route::get('/office_admin/{taskId}/sa_list', [OfficeAdminDashboardController::class,'taskSaList'])->name('office.saList');
Route::put('/office_admin/feedback', [OfficeAdminDashboardController::class, 'addFeedback'])->name('office.feedback');


//Reports
Route::get('/sa-report/{status?}', [OfficeAdminDashboardController::class, 'saReport'])->name('report.saReport');
Route::get('/office-report/', [OfficeAdminDashboardController::class, 'officeReport'])->name('report.officeReport');

//Route::resource('tasks', TaskController::class);

});