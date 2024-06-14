<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
        'middleware' => 'api',
        // 'prefix' => 'auth'
    ],function ($router) {
        Route::post('/login', [ApiController::class, 'login']);
        Route::post('/getUserProfile', [ApiController::class, 'getUserProfile']);
        Route::get('/getCompanyProfile', [ApiController::class, 'GetCompanyProfile']);
        Route::post('/forgotpassword', [ApiController::class, 'ForgotPassword']);
        Route::post('/checkindetails', [ApiController::class, 'GetCheckInDetails']);
        Route::post('/checkin', [ApiController::class, 'GetCheckIn']);
        Route::post('/attendance_details', [ApiController::class, 'GetAttendanceDetails']);
        Route::post('/edituserprofile', [ApiController::class, 'EditUserProfile']);
        Route::post('/changepassword', [ApiController::class, 'ChangePassword']);
        Route::post('/imageupload', [ApiController::class, 'UploadProfilePhoto']);
        Route::get('/getholidaylist', [ApiController::class, 'GetHolidayList']);
        Route::post('/getleavelist', [ApiController::class, 'GetLeaveList']);
        Route::post('/applyleave', [ApiController::class, 'ApplyLeave']);
        Route::post('/getnotificationlist', [ApiController::class, 'GetNotificationList']);
        Route::post('/getsalarylist', [ApiController::class, 'GetSalaryList']);
        Route::post('/getsalarydetails', [ApiController::class, 'GetSalaryDetails']);
        Route::post('/downloadsalary', [ApiController::class, 'DownloadSalary']);
        Route::post('/removeprofile', [ApiController::class, 'RemoveProfile']);
        Route::post('/cancelleave', [ApiController::class, 'CancelLeave']);
        Route::post('/app_version', [ApiController::class, 'App_Version']);
        Route::post('/homepage', [ApiController::class, 'HomePage']);
        Route::post('/sendnotification', [ApiController::class, 'SendNotification']);
        Route::post('/logout', [ApiController::class, 'Logout']);
        Route::post('/update_leave', [ApiController::class, 'update_leave']);
        Route::post('/year_list', [ApiController::class, 'YearList']);
        Route::post('/deleteaccount', [ApiController::class, 'DeleteAccount']);
        Route::post('/createaccount', [ApiController::class, 'CreateAccount']);
        }
);
