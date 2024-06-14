<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Employee\CheckinController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Employee\EmpLeaveController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Employee\EmpDashboardController;
use App\Http\Controllers\SystemInfoController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\OtherExpenseController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ApiController;
//use Hash;
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
Route::get('/test', [CommonController::class,'test']);

Route::get('clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});

Route::get('/', [LoginController::class,'Login']);
Route::get('login',[LoginController::class,'Login']);
Route::post('login',[LoginController::class, 'Login']);
Route::get('forgot_password',[LoginController::class,'forgot_password']);
Route::post('forgot_password',[LoginController::class,'forgot_password']);
Route::match(['get','post'],'reset_password/{token}',[LoginController::class,'reset_password']);
Route::get('logout',[LoginController::class,'logout']);
/* ----------------------1. Admin ---------------------- */

Route::group(['middleware' => ['usersession','cors','web'],
 ], function () {
Route::get('admin/dashboard',[AdminController::class,'dashboard']);
Route::get('admin/feedback-list',[CommonController::class,'feedbackList']);
Route::get('employee/admin_dashboard',[AdminController::class,'dashboard']);
Route::get('admin/analytics',[AdminController::class,'analytics']);
Route::get('employee/analytics',[AdminController::class,'analytics']);
Route::get('employee/analytics',[AdminController::class,'analytics']);
Route::get('admin/checkin',[CheckinController::class,'index']);

/* ----------------------2. Common ---------------------- */



Route::post('updateFcm',[CommonController::class,'updateFcm']);

Route::post('common/delete',[CommonController::class,'delete']);
Route::post('common/change_status',[CommonController::class,'changeStatus']);
Route::post('common/employeeChangeStatus',[CommonController::class,'employeeChangeStatus']);
Route::post('common/getDataById',[CommonController::class,'getDataById']);
Route::post('common/change_password',[CommonController::class,'change_password']);
Route::post('common/imageUpload',[CommonController::class,'imageUpload']);
Route::get('employee/myprofile',[CommonController::class,'employeedetail'])->name('employee_detail');
Route::get('admin/myprofile',[CommonController::class,'employeedetail']);
Route::post('common/removeimage',[CommonController::class,'removeimage']);

/* ----------------------3. Department ---------------------- */

Route::get('admin/department',[DepartmentController::class,'department']);
Route::post('adddepartment',[DepartmentController::class,'adddepartment']);


/* ----------------------4. Designation ---------------------- */

Route::get('admin/designation',[DesignationController::class,'designation']);
Route::get('admin/add_designation',[DesignationController::class,'add_designation']);
Route::get('admin/edit_designation/{id}',[DesignationController::class,'edit_designation']);
Route::post('post_designation',[DesignationController::class,'post_designation']);


/* ----------------------5. Holiday ---------------------- */

Route::get('admin/holidays',[HolidayController::class,'holiday']);
Route::post('add_holiday',[HolidayController::class,'add_holiday']);


/* ----------------------6. Employee ---------------------- */
Route::get('admin/search',[EmployeeController::class,'search']);
Route::get('admin/employees_list',[EmployeeController::class,'index']);
Route::get('admin/employees_list/{id}',[EmployeeController::class,'index']);
Route::get('admin/add_employee',[EmployeeController::class,'add']);
Route::post('admin/store_employee',[EmployeeController::class,'store']);
Route::get('admin/employee_details/{id}',[EmployeeController::class,'employeedetail'])->name('employee_details');
Route::get('/admin/edit_employee/{id}',[EmployeeController::class,'edit']);
Route::post('/admin/update_employee',[EmployeeController::class,'update']);
Route::get('getdesignationbyDept',[EmployeeController::class,'getdesignationbyDept']);
Route::post('admin/update_myprofile',[EmployeeController::class,'update_myprofile']);
Route::post('admin/getsalary',[EmployeeController::class,'getsalary']);
Route::post('admin/employee_salary',[EmployeeController::class,'employee_salary']);
Route::get('admin/employee_pagination',[EmployeeController::class,'pagination']);



/* ----------------------7. Attendance ---------------------- */

Route::get('admin/attendance_list',[AttendanceController::class,'attendance_list']);
Route::get('admin/view_break_detail',[AttendanceController::class,'view_break_detail']);
Route::post('getAttendanceByMonth',[AttendanceController::class,'getAttendanceByMonth']);
Route::get('admin/attendance_details/{id}',[AttendanceController::class,'attendance_details'])->name('attendancedetails');
Route::post('addAttendanceManually',[CheckinController::class,'addAttendanceManually']);

/* ---------------------- Admin Routes ---------------------- */


Route::get('projectlist','App\Http\Controllers\ProjectController@ListProject');
Route::get('projectlist1/{id}','App\Http\Controllers\ProjectController@status');
Route::post('projectlist2','App\Http\Controllers\ProjectController@addstatus');
Route::post('milestonestatus','App\Http\Controllers\ProjectController@updatemilestonestatus');
Route::get('editmilestone','App\Http\Controllers\ProjectController@editmilestone');
Route::get('viewprojecttask','App\Http\Controllers\ProjectController@viewprojecttask');
Route::get('admin/view_project_details/{id}','App\Http\Controllers\ProjectController@view_project_details');
Route::match(['get','post'],'addform','App\Http\Controllers\ProjectController@viewform');

Route::get('tasklist','App\Http\Controllers\TaskController@viewtask');
Route::match(['get','post'],'addtask','App\Http\Controllers\TaskController@addtask');
Route::match(['get','post'],'updatetask','App\Http\Controllers\TaskController@updatetask');
Route::get('/listtaskdata','App\Http\Controllers\TaskController@listtaskdata')->name('listtaskdata');
Route::get('searchtask/{id}/{status}','App\Http\Controllers\TaskController@searchtask')->name('searchtask');
Route::get('gettask','App\Http\Controllers\TaskController@edit');



/* ---------------------- Client ---------------------- */

Route::get('getemployee','App\Http\Controllers\EmployeeController@edit');
Route::match(['get','post'],'updateemployee','App\Http\Controllers\EmployeeController@updateemployee');
Route::get('projectdetails/{id}','App\Http\Controllers\ProjectController@projectdetails')->name('projectdetails');
Route::get('changestatus','App\Http\Controllers\EmployeeController@changestatus');
Route::match(['get','post'],'searchemployee','App\Http\Controllers\EmployeeController@searchemployee');
Route::match(['get','post'],'employeesearch','App\Http\Controllers\EmployeeController@search');
Route::get('/listemployeedata','App\Http\Controllers\EmployeeController@listemployeedata')->name('listemployeedata');
Route::match(['get','post'],'testing','App\Http\Controllers\DashboardController@test1');
Route::get('notification','App\Http\Controllers\NotificationController@notification');
Route::match(['get','post'],'addnotification','App\Http\Controllers\NotificationController@addnotification');

/*Ruchika ClientController*/
Route::get('admin/add_project',[ProjectController::class,'add_project']);
Route::post('admin/post_project',[ProjectController::class,'post_project']);
Route::get('admin/edit_project/{id}',[ProjectController::class,'edit_project']);
Route::post('project/delete_milestone',[ProjectController::class,'delete_milestone']);
Route::get('admin/projects_list',[ProjectController::class,'index']);
Route::get('admin/project_details/{id}',[ProjectController::class,'project_details']);
Route::post('/admin/edit_project',[ProjectController::class,'edit_project']);
Route::post('/admin/add_attachment',[ProjectController::class,'add_attachment']);
Route::post('/admin/searchProject',[ProjectController::class,'searchProject']);
Route::post('admin/getprojectdescription',[ProjectController::class,'getprojectdescription']);
Route::get('admin/edit_project_description',[ProjectController::class,'edit_project_description']);
Route::post('/admin/edit_project_description',[ProjectController::class,'edit_project_description']);
/*Task*/
Route::get('admin/tasks_list',[TaskController::class,'viewtask']);
Route::get('admin/viewprojecttask',[ProjectController::class,'viewprojecttask']);
Route::post('GetTaskDetailsById',[TaskController::class,'GetTaskDetailsById']);
Route::post('task/post_task',[TaskController::class,'post_task']);
Route::post('task/getTaskList',[TaskController::class,'getTaskList']);
Route::post('task/getTaskEmplist',[TaskController::class,'getTaskEmplist']);
Route::post('task/getTaskCount',[TaskController::class,'getTaskCount']);
Route::get('task/TaskDetails',[TaskController::class,'TaskDetails']);
Route::get('task/changeTaskStatus',[TaskController::class,'changeTaskStatus']);
Route::post('task/add_comments',[TaskController::class,'AddComments']);
Route::post('task/getTaskCommentList',[TaskController::class,'getTaskCommentList']);
Route::post('task/task_tracking',[TaskController::class,'taskTracking']);
Route::post('task/getTaskTrackingList',[TaskController::class,'getTaskTrackingList']);
Route::post('task/delete_task',[TaskController::class,'delete_task']);
Route::post('GetProjectMemberList',[TaskController::class,'GetProjectMemberList']);

Route::get('employee/tasks_list',[TaskController::class,'viewtask']);

Route::get('getEmployeeListByUserId',[TaskController::class,'getEmployeeListByUserId']);
Route::post('getReportByUserId',[TaskController::class,'getReportByUserId']);
Route::post('admin/getHoursReportByUserId',[TaskController::class,'getHoursReportByUserId']);


/* ---------------------- Client ---------------------- */

/*Route::get('clientdetails/{id}','App\Http\Controllers\ClientController@client_details')->name('clientdetails');
Route::get('getclient','App\Http\Controllers\ClientController@getclient');
Route::post('updateclient','App\Http\Controllers\ClientController@updateclient');
Route::get('getemployee','App\Http\Controllers\EmployeeController@edit');
Route::match(['get','post'],'updateemployee','App\Http\Controllers\EmployeeController@updateemployee');
Route::match(['get','post'],'search','App\Http\Controllers\ClientController@search');
Route::get('projectdetails/{id}','App\Http\Controllers\ProjectController@projectdetails')->name('projectdetails');
Route::get('changestatus','App\Http\Controllers\EmployeeController@changestatus');
Route::match(['get','post'],'searchemployee','App\Http\Controllers\EmployeeController@searchemployee');
Route::match(['get','post'],'employeesearch','App\Http\Controllers\EmployeeController@search');
Route::get('/listemployeedata','App\Http\Controllers\EmployeeController@listemployeedata')->name('listemployeedata');
Route::match(['get','post'],'testing','App\Http\Controllers\DashboardController@test1');
Route::get('notification','App\Http\Controllers\NotificationController@notification');
Route::match(['get','post'],'addnotification','App\Http\Controllers\NotificationController@addnotification');*/



Route::get('admin/clients_list',[ClientController::class,'clients_list']);
Route::get('admin/add_client',[ClientController::class,'add_client']);
Route::post('admin/addclient',[ClientController::class,'addclients']);
Route::get('admin/client_details/{id}',[ClientController::class,'client_details']);
Route::get('admin/edit_client/{id}',[ClientController::class,'edit_client']);
Route::post('admin/update_client',[ClientController::class,'update_client']);
Route::post('admin/getclientcomments',[ClientController::class,'getclientcomments']);
Route::post('admin/client_conversion',[ClientController::class,'client_conversion']);
Route::get('admin/add_client_milestone',[ClientController::class,'add_client_milestone']);
Route::post('admin/searchClient',[ClientController::class,'searchClient']);
Route::post('admin/getdescription',[ClientController::class,'getdescription']);
Route::post('admin/getadditionalnotes',[ClientController::class,'getadditionalnotes']);
Route::post('admin/checkEmail',[ClientController::class,'checkEmail']);
Route::post('add_project_bid',[ClientController::class,'add_project_bid']);
Route::get('admin/project_bid_list',[ClientController::class,'project_bid_list']);

Route::get('listleaves','App\Http\Controllers\Employee\EmpLeaveController@listleave');

Route::get('adminprofile','App\Http\Controllers\AdminController@profile');
Route::get('setting','App\Http\Controllers\AdminController@setting');

/* ---------------------- Employee Routes ---------------------- */

Route::get('employee/dashboard',[EmpDashboardController::class,'dashboard']);
Route::get('employee/holidays',[HolidayController::class,'view']);
Route::get('employee/checkin',[CheckinController::class,'index']);
Route::get('employee/holidays_list',[HolidayController::class,'view']);
Route::get('empprojectlist',[EmpProjectController::class,'ListProject']);
// Route::get('employee/leavelist',[EmpLeaveController::class,'leavelist']);
Route::post('employee/office_lock',[EmployeeController::class,'OfficeLock']);
Route::get('employee/attendance_details/{id}',[AttendanceController::class,'attendance_details']);


/* Punch Routes */
Route::post('saveCheckin',[CheckinController::class,'storePunch']);
Route::post('saveBreakin',[CheckinController::class,'storeBreak']);
Route::get('projects','App\Http\Controllers\DashboardController@project');
Route::get('employees','App\Http\Controllers\DashboardController@employee');

/*Ruchika*/
Route::get('empforsalaryslip',[SalaryController::class,'getEmployee']);
Route::get('admin/add_salary_slip',[SalaryController::class,'salaryslip']);
Route::post('admin/add_salary',[SalaryController::class,'addsalary']);
Route::get('admin/salary/{id}',[SalaryController::class,'salary']);
Route::get('admin/salary_list',[SalaryController::class,'salary_list']);
Route::get('downloadSalarySlip/{id}',[SalaryController::class,'downloadSalarySlip']);
Route::match(['get','post'],'admin/salaryByYear',[SalaryController::class,'salaryByYear']);
Route::post('admin/empSalarySlipInfo',[SalaryController::class,'empSalarySlipInfo']);
Route::get('employee/salary_details',[SalaryController::class,'empSalaryDetails']);
Route::get('admin/listsalaryslip',[SalaryController::class,'salarySlipList']);
Route::match(['get','post'],'admin/editsalaryslip/{id}',[SalaryController::class,'editsalaryslip']);
Route::post('admin/generateSalarySlip',[SalaryController::class,'generate']);
Route::post('admin/submitSalarySlip',[SalaryController::class,'submitSalary']);
Route::post('admin/getSalarybyMonth',[SalaryController::class,'getSalarybyMonth']);
Route::post('admin/sendSalarySlip',[SalaryController::class,'sendSalarySlip']);
Route::get('admin/deleteSalarySlip',[SalaryController::class,'deleteSalarySlip']);
/*Employee Leave*/

Route::get('admin/leave/pending_leave',[EmpLeaveController::class,'pending_leave']);
Route::get('employee/leave/pending_leave',[EmpLeaveController::class,'pending_leave']);
Route::get('admin/leave/all_leave',[EmpLeaveController::class,'all_leave']);
Route::get('employee/leave/all_leave',[EmpLeaveController::class,'all_leave']);
Route::post('add_empleave',[EmpLeaveController::class,'add_empleave']);
Route::post('admin/leave/reply',[EmpLeaveController::class,'viewreply']);
Route::get('employee/leave_list',[EmpLeaveController::class,'emp_leave_list']);
Route::post('admin/add_reply',[EmpLeaveController::class,'add_reply']);
Route::post('employee/cancelleave',[EmpLeaveController::class,'cancelleave']);
Route::post('admin/leave_details',[EmpLeaveController::class,'leave_details']);


/*Company Profile*/
Route::get('admin/company_profile',[CompanyController::class,'viewprofile']);
Route::post('admin/add_companyprofile',[CompanyController::class,'add_companyprofile']);

/*------Candidate Controller*/
Route::get('admin/candidate',[CandidateController::class,'candidate']);
Route::post('admin/add_candidate',[CandidateController::class,'addcandidate']);
Route::get('admin/candidate_list',[CandidateController::class,'list']);
Route::get('employee/candidate_list2',[CandidateController::class,'list2']);
Route::get('getdesignationbyDepartment',[CandidateController::class,'getdesignationbyDepartment']);
Route::post('admin/candidate_status',[CandidateController::class,'candidate_status']);
Route::post('admin/sendMailAgain',[CandidateController::class,'sendMailAgain']);
Route::post('admin/interview_schedule',[CandidateController::class,'candidate_status']);
Route::get('/admin/edit_candidate/{id}',[CandidateController::class,'edit_candidate']);
Route::get('/admin/view_candidate/{id}',[CandidateController::class,'view_candidate']);
Route::post('/admin/addqualification',[CandidateController::class,'addqualification']);

/*----------SystemInformation Controller--------------*/

Route::get('admin/analystics_system_information',[SystemInfoController::class,'analystics_system_information']);
Route::post('/admin/add_system_information',[SystemInfoController::class,'add_system_information']);
Route::post('admin/system_info_details',[SystemInfoController::class,'system_info_details']);
Route::get('admin/mobile_information',[SystemInfoController::class,'mobile_information']);
Route::get('admin/laptop_information',[SystemInfoController::class,'laptop_information']);


/* ----------------------8. Notification ----------------------*/
Route::get('admin/notification',[NotificationController::class,'notification']);
Route::post('admin/add_notification',[NotificationController::class,'add_notification']);
Route::get('admin/notification_list',[NotificationController::class,'notification_list']);
Route::get('admin/send_notification',[NotificationController::class,'send_notification']);
Route::post('admin/send_to',[NotificationController::class,'send_to']);
Route::post('admin/notification_details',[NotificationController::class,'notification_details']);
Route::get('admin/notification_pagination',[NotificationController::class,'pagination']);
Route::get('employee/notification_list',[NotificationController::class,'notification_list']);
// Other Expense Controller
// Route::get('admin/other_expense',[OtherExpenseController::class,'other_expense']);
// Route::post('admin/add_expense',[OtherExpenseController::class,'add_expense']);
Route::get('admin/other_expense',[OtherExpenseController::class,'other_expense']);
Route::post('admin/add_expense',[OtherExpenseController::class,'add_expense']);
Route::post('admin/add_other_expense',[OtherExpenseController::class,'add_other_expense']);
Route::get('admin/list_other_expense',[OtherExpenseController::class,'list_other_expense']);
Route::get('/admin/edit_other_expense/{id}',[OtherExpenseController::class,'edit_other_expense']);
Route::post('admin/download_expenses',[OtherExpenseController::class,'download_expenses']);
Route::get('employee/other_expense',[OtherExpenseController::class,'other_expense']);
Route::get('/employee/edit_other_expense/{id}',[OtherExpenseController::class,'edit_other_expense']);
Route::post('employee/add_expense',[OtherExpenseController::class,'add_expense']);
Route::get('employee/list_other_expense',[OtherExpenseController::class,'list_other_expense']);

});
Route::post('add_expense_category',[OtherExpenseController::class,'add_expense_category']);
Route::get('admin/expense_category_list',[OtherExpenseController::class,'expense_category_list']);




/*Access Permission*/
/* ----------------------1. Admin ---------------------- */
//'permission',
 Route::group(['middleware' => ['cors'],
 ], function () {

Route::get('employee/department',[DepartmentController::class,'department']);
Route::post('adddepartment',[DepartmentController::class,'adddepartment']);


/* ----------------------2. Designation ---------------------- */

Route::get('employee/designation',[DesignationController::class,'designation']);
Route::get('employee/add_designation',[DesignationController::class,'add_designation']);
Route::get('employee/edit_designation/{id}',[DesignationController::class,'edit_designation']);
Route::post('post_designation',[DesignationController::class,'post_designation']);


/* ----------------------3. Holiday ---------------------- */

Route::get('employee/holidays',[HolidayController::class,'holiday']);
Route::post('add_holiday',[HolidayController::class,'add_holiday']);


/* ----------------------4. Employee ---------------------- */
Route::get('admin/search',[EmployeeController::class,'search']);
Route::get('employee/employees_list',[EmployeeController::class,'index']);
Route::get('employee/add_employee',[EmployeeController::class,'add']);
Route::post('admin/store_employee',[EmployeeController::class,'store']);
Route::get('employee/employee_details/{id}',[EmployeeController::class,'employeedetail'])->name('employee_details');
Route::get('/employee/edit_employee/{id}',[EmployeeController::class,'edit']);
Route::post('/admin/update_employee',[EmployeeController::class,'update']);
Route::get('getdesignationbyDept',[EmployeeController::class,'getdesignationbyDept']);
Route::post('admin/update_myprofile',[EmployeeController::class,'update_myprofile']);



/* ----------------------5. Attendance ---------------------- */

Route::get('employee/attendance_list',[AttendanceController::class,'attendance_list']);
Route::post('getAttendanceByMonth',[AttendanceController::class,'getAttendanceByMonth']);
/*Route::get('employee/attendance_details/{id}',[AttendanceController::class,'attendance_details'])->name('attendancedetails');*/
Route::post('addAttendanceManually',[CheckinController::class,'addAttendanceManually']);

/* ----------------------6. Client ---------------------- */
Route::get('listleaves','App\Http\Controllers\Employee\EmpLeaveController@listleave');
Route::get('adminprofile','App\Http\Controllers\AdminController@profile');
Route::get('setting','App\Http\Controllers\AdminController@setting');

/* ----------------------7. Salary ---------------------- */

Route::get('empforsalaryslip',[SalaryController::class,'getEmployee']);
Route::get('employee/add_salary_slip',[SalaryController::class,'salaryslip']);
Route::post('admin/add_salary',[SalaryController::class,'addsalary']);
Route::get('employee/salary/{id}',[SalaryController::class,'salary']);
Route::get('employee/salary_list',[SalaryController::class,'salary_list']);
Route::get('downloadSalarySlip/{id}',[SalaryController::class,'downloadSalarySlip']);
Route::match(['get','post'],'employee/salaryByYear',[SalaryController::class,'salaryByYear']);
Route::post('admin/empSalarySlipInfo',[SalaryController::class,'empSalarySlipInfo']);
Route::get('employee/salary_details',[SalaryController::class,'empSalaryDetails']);

/* ----------------------8. Leave ---------------------- */

Route::get('employee/leave/pendingleave',[EmpLeaveController::class,'viewleave']);
Route::post('add_empleave',[EmpLeaveController::class,'add_empleave']);
Route::post('admin/leave/reply',[EmpLeaveController::class,'viewreply']);
Route::get('employee/leavelist',[EmpLeaveController::class,'leavelist']);
Route::post('admin/add_reply',[EmpLeaveController::class,'add_reply']);

/* ----------------------10. Company_profile ---------------------- */
Route::get('employee/company_profile',[CompanyController::class,'viewprofile']);
Route::post('admin/add_companyprofile',[CompanyController::class,'add_companyprofile']);

/* ----------------------11. Candidate ---------------------- */
Route::get('employee/candidate',[CandidateController::class,'candidate']);
Route::post('admin/add_candidate',[CandidateController::class,'addcandidate']);
Route::get('employee/candidate_list',[CandidateController::class,'list']);
Route::get('getdesignationbyDepartment',[CandidateController::class,'getdesignationbyDepartment']);

/*----------------------12. SystemInformation-------------------*/
Route::post('/admin/add_system_information',[SystemInfoController::class,'add_system_information']);
Route::post('admin/system_info_details',[SystemInfoController::class,'system_info_details']);
Route::get('employee/laptop_information',[SystemInfoController::class,'laptop_information']);
Route::get('employee/analystics_system_information',[SystemInfoController::class,'analystics_system_information']);


/* ----------------------13. Notification ----------------------*/
Route::get('employee/notification',[NotificationController::class,'notification']);
Route::post('admin/add_notification',[NotificationController::class,'add_notification']);
Route::get('employee/notification_list',[NotificationController::class,'notification_list']);
Route::get('admin/send_notification',[NotificationController::class,'send_notification']);
Route::post('admin/send_to',[NotificationController::class,'send_to']);
Route::post('admin/notification_details',[NotificationController::class,'notification_details']);

/*------------------------15. Other Expense --------------*/
Route::get('employee/other_expense',[OtherExpenseController::class,'other_expense']);
Route::post('employee/add_expense',[OtherExpenseController::class,'add_expense']);

/*------------------------14. Permission --------------*/
Route::get('employee/permission',[PermissionController::class,'permission']);
Route::post('/admin/add_permission',[PermissionController::class,'add_permission']);

});
/* ----------------------9. Cron ----------------------*/
Route::get('checkoutManually',[CronController::class,'checkoutManually']);
Route::get('generatePin',[CronController::class,'generatePin']);
Route::get('checkBreakTime',[CronController::class,'checkBreakTime']);
Route::get('monthlyLeaveUpdate',[CronController::class,'monthlyLeaveUpdate']);
Route::get('generateBackup',[CronController::class,'generateBackup']);

Route::get('employee/analytics',[AdminController::class,'employee_analytics']);

Route::get('employee/view_candidate/{id}',[CandidateController::class,'view_candidate']);
Route::get('/employee/edit_candidate/{id}',[CandidateController::class,'edit_candidate']);
Route::get('employee/interview_list',[CandidateController::class,'interview_list']);

Route::get('employee/mobile_information',[SystemInfoController::class,'mobile_information']);
Route::get('employee/laptop_information',[SystemInfoController::class,'laptop_information']);
Route::get('employee/employees_list/{id}',[EmployeeController::class,'index']);
Route::get('employee/clients_list',[ClientController::class,'clients_list']);
Route::get('employee/add_client',[ClientController::class,'add_client']);
Route::get('employee/client_details/{id}',[ClientController::class,'client_details']);
Route::get('employee/edit_client/{id}',[ClientController::class,'edit_client']);
Route::get('employee/view_break_detail',[AttendanceController::class,'view_break_detail']);
Route::get('employee/listsalaryslip',[SalaryController::class,'salarySlipList']);

Route::get('employee/add_project',[ProjectController::class,'add_project']);
Route::get('employee/edit_project/{id}',[ProjectController::class,'edit_project']);
Route::get('employee/edit_project',[ProjectController::class,'edit_project']);
Route::get('employee/projects_list',[ProjectController::class,'index']);
Route::get('employee/project_details/{id}',[ProjectController::class,'project_details']);
Route::get('employee/view_project_details/{id}',[ProjectController::class,'view_project_details']);

Route::get('employee/clients_list',[ClientController::class,'clients_list']);
Route::get('employee/add_client',[ClientController::class,'add_client']);
Route::get('employee/client_details/{id}',[ClientController::class,'client_details']);
Route::get('employee/edit_client/{id}',[ClientController::class,'edit_client']);
Route::get('employee/add_client_milestone',[ClientController::class,'add_client_milestone']);

/*Template controller*/
Route::get('admin/template_list',[TemplateController::class,'index']);
Route::get('admin/add_template',[TemplateController::class,'add_template']);
Route::get('admin/edit_template/{id}',[TemplateController::class,'edit_template']);
Route::get('admin/view_template/{id}',[TemplateController::class,'view_template']);
Route::get('employee/template_list',[TemplateController::class,'index']);
Route::get('employee/add_template',[TemplateController::class,'add_template']);
Route::get('employee/edit_template',[TemplateController::class,'add_template']);
Route::get('employee/edit_template/{id}',[TemplateController::class,'edit_template']);
Route::get('employee/view_template/{id}',[TemplateController::class,'view_template']);
Route::post('/admin/post_template',[TemplateController::class,'post_template']);
Route::post('/admin/delete_template',[TemplateController::class,'delete_template']);


Route::get('admin/task_board',[TaskController::class,'task_board']);
Route::get('employee/task_board',[TaskController::class,'task_board']);

Route::get('employee/database_backup',[CommonController::class,'database_backup']);

Route::get('employee/sendFcmToken/{id}',[CommonController::class,'sendFcmToken']);
Route::get('updateQA',[TaskController::class,'updateQA']);
Route::get('admin/database_backup',[CommonController::class,'database_backup']);
Route::get('admin/generate_backup',[CommonController::class,'generate_backup']);

Route::get('admin/feedback',[CommonController::class,'feedback']);
Route::get('employee/feedback',[CommonController::class,'feedback']);
Route::post('common/post_feedback',[CommonController::class,'PostFeedback']);
