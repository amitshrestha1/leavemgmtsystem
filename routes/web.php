<?php

use App\Livewire\Admin\Auth\CreateUser;
use App\Livewire\Admin\Auth\EditUser;
use App\Livewire\Admin\Auth\ForgotPasswordEmail;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\Logout;
use App\Livewire\Admin\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Users;
use App\Livewire\Admin\Calendar\Calendar;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\Department\CreateDepartment;
use App\Livewire\Admin\Department\Departments;
use App\Livewire\Admin\Department\EditDepartment;
use App\Livewire\Admin\Holiday\CreateHoliday;
use App\Livewire\Admin\Holiday\Holiday;
use App\Livewire\Admin\HolidayMode\HolidayMode;
use App\Livewire\Admin\Leave\ApplyLeave;
use App\Livewire\Admin\Leave\Leave;
use App\Livewire\Admin\LeaveEntitlement\CreateLeaveEntitlement;
use App\Livewire\Admin\LeaveEntitlement\LeaveEntitlement;
use App\Livewire\Admin\LeaveType\CreateLeaveType;
use App\Livewire\Admin\LeaveType\LeaveType;
use App\Livewire\Admin\RolesandPermission\Permissionmanagement;
use App\Livewire\UserLeaveBalance;
use Livewire\Livewire;

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
// AUTH
Route::group(['middleware' => 'logincheck'], function () {
    Route::get('/login', Login::class)->name('login');
});

Route::get('/forgotpasswordlink', ForgotPasswordEmail::class)->name('admin.sendlink');
Route::get('reset/{token}', ResetPassword::class)->name('admin.resetpassword');

Route::group(['middleware' => 'auth'], function () {


    Route::group(['middleware' => ['can:User']], function () {
        Route::get('/user', Users::class)->name('admin.user');
        Route::get('/createuser', CreateUser::class)->name('admin.createuser');
        Route::get('/edituser/{user}', EditUser::class)->name('admin.edituser');
    });
    Route::group(['middleware' => ['can:Department']], function () {
        // Department Route
        Route::get('/department', Departments::class)->name('admin.department');
        Route::get('/createdepartment', CreateDepartment::class)->name('admin.createdepartment');
        Route::get('/editdepartment/{department}', EditDepartment::class)->name('admin.editdepartment');
    });
    Route::group(['middleware' => ['can:LeaveType']], function () {
        // Leave Type
        Route::get('/type', LeaveType::class)->name('admin.type');
        Route::get('/typecreate', CreateLeaveType::class)->name('admin.typecreate');
    });
    Route::group(['middleware' => ['can:Leave']], function () {
        // Leave
        Route::get('/leave', Leave::class)->name('admin.leave');
        Route::get('/applyleave', ApplyLeave::class)->name('admin.applyleave');
    });
    Route::group(['middleware' => ['can:Calendar']], function () {
        // Calendar
        Route::get('/calendar', Calendar::class)->name('admin.calendar');
    });
    Route::group(['middleware' => ['can:UserLeaveBalance']], function () {
        // User Leave Balance
        Route::get('/userleavebalance', UserLeaveBalance::class)->name('admin.userleavebalance');
    });
    Route::group(['middleware' => ['can:Permission']], function () {
        Route::get('/permissions', Permissionmanagement::class)->name('admin.permissionmanagement');
    });
    Route::group(['middleware' => ['can:Holiday']], function () {

        // Holiday
        Route::get('/holiday', Holiday::class)->name('admin.holiday');
        Route::get('/createholiday', CreateHoliday::class)->name('admin.createholiday');
    });
    Route::group(['middleware' => ['can:HolidayMode']], function () {
        // Holiday Mode
        Route::get('/mode', HolidayMode::class)->name('admin.mode');
    });
    Route::group(['middleware' => ['can:LeaveEntitlement']], function () {
        //Leave Entitlement
        Route::get('/leaveentitlement', LeaveEntitlement::class)->name('admin.leaveentitlement');
        Route::get('/createleaveentitlement', CreateLeaveEntitlement::class)->name('admin.createleaveentitlement');
    });
    // User Route
    Route::get('/logout', Logout::class)->name('logout');
    // Dashboard
    Route::get('/', Dashboard::class)->name('admin.dashboard');
});
