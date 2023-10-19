<?php

use App\Http\Controllers\Admin\Academic\FacultyDepartmentProgramController;
use App\Http\Controllers\Admin\HRIS\Employee\InformationController;
use App\Http\Controllers\Admin\Settings\ApplicationSettingsController;
use App\Http\Controllers\Admin\Settings\SessionAndEventController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|Admin Route contains routes of administrative features like: system-check, human resource information system, academic information,
|admission applicants, etc.
|
 * ------------------------------------------------------------------------
 * Open Routes: do not require middleware check
 * ------------------------------------------------------------------------
 */
/**
 * ============= System-check Routes =================
 **/
Route::group(['prefix' => 'system'], static function () {
    Route::get('super-user-check',[ApplicationSettingsController::class,'checkSuperUserExistence']);
});
/**
 * ============ Authentication Routes ================
**/
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password/generate-otp', [AuthController::class, 'generateOtp']);
Route::post('forgot-password/update', [AuthController::class, 'updatePassword']);

Route::controller(InformationController::class)->group(function () {
    Route::group(['prefix' => 'profile'], static function () {
        Route::group(['prefix' => 'information'], static function () {
            Route::post('create-profile', 'create');
        });
    });
});

/*
 * ------------------------------------------------------------------------
 * Protected Routes: Requires middleware check
 * ------------------------------------------------------------------------
 */
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('check-authentication', [AuthController::class, 'checkAuthentication']);
    Route::get('logout', [AuthController::class, 'logout']);
    /**
     *****************************************************************
     * Application Settings Routes
     * ***************************************************************
     **/
    Route::controller(ApplicationSettingsController::class)->group(function () {
        Route::get('application-settings', 'getApplicationSettings');
        Route::post('application-settings', 'applicationSettings');
    });
    /**
     *****************************************************************
     * Session and Event Routes
     * ***************************************************************
     **/
    Route::controller(SessionAndEventController::class)->group(function () {
        Route::get('session-list', 'sessionList');
        Route::post('session-new', 'addNewSession');
        Route::get('session/edit/{session}', 'editSession');
        Route::post('session/update/{session}', 'updateSession');
        /************** Event Types ***************/
        Route::group(['prefix' => 'event'], static function () {
            Route::get('type/list', 'eventTypeList');
            Route::post('type/add', 'eventTypeAdd');
        });
    });
    /**
     * ******************************************************
     * Academic Routes - Faculty Information Routes
     * ******************************************************
     */
    Route::group(['prefix' => 'academic'], function () {
        Route::controller(FacultyDepartmentProgramController::class)->group(function () {
            Route::group(['prefix' => 'faculty'], function () {
                Route::get('list', 'facultyList');
                Route::post('new', 'addNewFaculty');
                Route::patch('update/{faculty}', 'updateFaculty');
                Route::get('remove/{faculty}', 'removeFaculty');
            });
            Route::group(['prefix' => 'department'], function () {
                Route::get('list', 'departmentList');
                Route::post('new', 'addNewDepartment');
                Route::patch('update/{faculty}', 'updateDepartment');
                Route::get('remove/{faculty}', 'removeDepartment');
            });
            Route::group(['prefix' => 'program'], function () {
                Route::get('list', 'programList');
                Route::post('new', 'addNewProgram');
                Route::patch('update/{faculty}', 'updateProgram');
                Route::get('remove/{faculty}', 'removeProgram');
            });
        });
    });
});
