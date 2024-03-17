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
Route::get('/', ['middleware' => 'guest', function()
{
    return view('auth.login');
}]);
Route::get('/profile',  'App\Http\Controllers\profile@imageCrop');

Auth::routes();//['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

 Route::post('/profile/upImage/', [App\Http\Controllers\profile::class, 'uploadIMG']);

// Route::get('/sidebar', function()
// {
//     return view('includes.sidebar');
// });
Route::get('/calendar', [App\Http\Controllers\EventsController::class, 'index'])->name('calendar.index');
Route::get('/load', [App\Http\Controllers\EventsController::class, 'load'])->name('calendar.index');
Route::post('calendar/create-event', [App\Http\Controllers\EventsController::class, 'create'])->name('calendar.create');
Route::patch('calendar/edit-event', [App\Http\Controllers\EventsController::class, 'edit'])->name('calendar.edit');
Route::delete('calendar/remove-event', [App\Http\Controllers\EventsController::class, 'destroy'])->name('calendar.destroy');

Route::get('/course',  'App\Http\Controllers\CoursemodelController@index');
Route::get('/subject',  'App\Http\Controllers\CoursemodelController@loadSubject');
Route::get('/fetchSubjects/{courseId}',  'App\Http\Controllers\CoursemodelController@fetchSubjects');
Route::delete('/delete-subject/{subject}', 'App\Http\Controllers\CoursemodelController@deleteSubject');
Route::post('/add-subject', 'App\Http\Controllers\CoursemodelController@addSubject');

Route::post('/cour',  'App\Http\Controllers\CoursemodelController@create');
Route::get('/course/fetchdata',  'App\Http\Controllers\CoursemodelController@showdata');
Route::post('/course/disable',  'App\Http\Controllers\CoursemodelController@disable');
Route::post('/addbatch',  'App\Http\Controllers\CoursemodelController@createbatch');

Route::get('/viewBatchsubject', 'App\Http\Controllers\BatchController@fetchSubjectsforteacher');
Route::get('/fetchbatchSubjects/{batch_id}',  'App\Http\Controllers\BatchController@fetchSubjects')->name('batch.subject');;
Route::get('/batch',  'App\Http\Controllers\BatchController@index');
Route::get('/batch/fetchdata',  'App\Http\Controllers\BatchController@showdata');
Route::post('/batch/disable',  'App\Http\Controllers\BatchController@disable');
Route::post('/activatebatchsubject',  'App\Http\Controllers\BatchController@disableBatchSubject');
Route::get('/loadinstructor',  'App\Http\Controllers\BatchController@loadinstructor');

Route::get('/get_batches/{batchid}', 'App\Http\Controllers\ApplicantController@getCourses');
Route::get('/applicant',  'App\Http\Controllers\ApplicantController@index')->name('applicant.index');
Route::post('/addapplicant',  'App\Http\Controllers\ApplicantController@store')->name('applicant.store');
Route::get('/showApplicant/{batch_id}',  'App\Http\Controllers\ApplicantController@showApplicant')->name('applicant.show');
Route::get('/get_Applicant/{applicantid}', 'App\Http\Controllers\ApplicantController@getApplicant')->name('applicant.list');
Route::post('/viewApplicant',  'App\Http\Controllers\ApplicantController@viewApplicant')->name('applicant.viewApplicant');
Route::post('/editApplicant',  'App\Http\Controllers\ApplicantController@editApplicant')->name('applicant.editApplicant');
Route::post('/regStudent',  'App\Http\Controllers\ApplicantController@registerStudent')->name('student.register');
Route::get('/getApplicantByNIC/{nic}', 'App\Http\Controllers\ApplicantController@getApplicantbyNIC');
Route::get('/loadstudent',  'App\Http\Controllers\ApplicantController@loadstudent');
Route::get('/get_student/{selectedBatchId}', 'App\Http\Controllers\ApplicantController@getstudents')->name('student.list');

Route::get('/timetable',  'App\Http\Controllers\timetableController@index');
Route::get('/timetable/fetch-subjects/{courseId}',  'App\Http\Controllers\timetableController@fetchSubjects');
Route::get('/timetable/load', [App\Http\Controllers\timetableController::class, 'load'])->name('calendar.index');
Route::post('/timetable/create-event', [App\Http\Controllers\timetableController::class, 'create'])->name('calendar.create');
Route::patch('/timetable/edit-event', [App\Http\Controllers\timetableController::class, 'edit'])->name('calendar.edit');
Route::delete('/timetable/remove-event', [App\Http\Controllers\timetableController::class, 'destroy'])->name('calendar.destroy');

Route::get('/academic',  'App\Http\Controllers\AcadamicstaffController@index');
Route::post('/check-username-availability', 'App\Http\Controllers\AcadamicstaffController@checkUsernameAvailability');
Route::post('/addAcademic', 'App\Http\Controllers\AcadamicstaffController@addAcademic');
Route::get('/fetchInstructor', 'App\Http\Controllers\AcadamicstaffController@fetchInstructor');
Route::post('/viewacademic', 'App\Http\Controllers\AcadamicstaffController@viewacademic');
Route::post('/editAcademic', 'App\Http\Controllers\AcadamicstaffController@editAcademic');
Route::post('/activateacadamic', 'App\Http\Controllers\AcadamicstaffController@activateacadamic');
Route::get('/courses',  'App\Http\Controllers\AcadamicstaffController@loadCourse');
Route::post('/save-assignment', 'App\Http\Controllers\AcadamicstaffController@assignsubjectteacher');

Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::put('roles/{role}/permissions', [ App\Http\Controllers\RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');
Route::post('assignRolesByDesignation', [App\Http\Controllers\RoleController::class, 'assignRolesByDesignation'])->name('assignRolesByDesignation');
Route::post('assignRolesToUser', [App\Http\Controllers\RoleController::class, 'assignPermissionToUser'])->name('assignPermissionToUser');

Route::get('/studentattendence/{user}',  'App\Http\Controllers\attendencecontroller@loadbatch');
Route::get('/getSubjectAttendence/{batchId}', 'App\Http\Controllers\attendencecontroller@getSubjectAttendence')->name('getSubjects');

Route::post('/addDeviceInitial', [App\Http\Controllers\rfidcontroller::class, 'initializedevice'])->name('initializedevice');
Route::post('/checkRfidEntryStatus', [App\Http\Controllers\rfidcontroller::class, 'checkRfidEntryStatus']);
Route::post('/assign-rfid-data', [App\Http\Controllers\rfidcontroller::class, 'assingrfid']);
Route::get('/getStudentAttendance/{batchId}/{subjectId}/{year}/{month}/{type}','App\Http\Controllers\attendencecontroller@getStudentAttendance');


Route::post('/studentPayment/{studentPaymentModel}', 'App\Http\Controllers\ApplicantController@updatePayment')->name('student.payment');
Route::get('/Payment', 'App\Http\Controllers\ApplicantController@PaymentView')->name('student.viewPayment');
Route::get('/studentPaymentView/{Applicant_id}', 'App\Http\Controllers\ApplicantController@StudentPaymentView')->name('Admin.viewPayment');
Route::post('/studentPaymentUpdate/{Payment_id}', 'App\Http\Controllers\ApplicantController@StudentPaymentUpdate')->name('Admin.UpdatePayment');


