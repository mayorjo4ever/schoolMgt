<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

*/

Route::get('/', function () {
    ## return view('welcome');
    return redirect('portal/login');
});

/***
Route::get('/login', function () {
    ## return view('welcome');
    return redirect('portal/login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

*/

## login page
##===================
Route::prefix('/portal')->namespace('App\Http\Controllers\Portal')->group(function(){
    Route::match(['get','post'],'login','LoginController@login');
    Route::match(['get','post'],'forgot-password','LoginController@forgot_password');
    Route::get('logout','LoginController@logout');
});


## administrator end
##===================

// Admin dashboard without admin
 Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
## Route::prefix('/portal')->namespace('App\Http\Controllers\Admin')->group(function(){

    ## Route::match(['get','post'],'login','AdminController@login');

    Route::group(['middleware'=>['admin']],function(){

    ##    Route::get('/',function(){ return  dd(array('me'=>'trying to view admin'));});
        Route::get('dashboard','AdminController@dashboard');

        // update admin password
        Route::match(['get','post'], 'update-admin-password',
            'AdminController@updateAdminPassword');

        // check admin password
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');
          // update admin status
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');
        // update admin details
        Route::match(['get','post'], 'update-admin-details',
                'AdminController@updateAdminDetails');

        // view subject details
        Route::get('subjects/{id?}','SubjectController@subjects');
        Route::match(['get','post'],'add-edit-subject/{sid?}',
                'SubjectController@addEditSubject');
        Route::get('manage-subject-for-levels',
                'SubjectController@subjectForLevels');
        Route::post('load-level-subjects',
                'SubjectController@load_level_subjects');
        Route::post('submit-level-subjects-definition',
                'SubjectController@submit_level_subjects_definition');

        Route::post('remove-level-subjects-definition',
                'SubjectController@remove_level_subjects_definition');

        Route::get('get-subject-name/{id}', 'SubjectController@get_subject_name');

        Route::match(['get','post'],'subject-grade-settings/{gradeId?}',
                'SubjectController@subject_grading');

        Route::get('delete-subject-grade/{id}','SubjectController@delete_subject_grade');

        Route::match(['get','post'],'test_exam_marks_settings/{id?}',
                'SubjectController@test_exam_marks_setup');




        // view question details
        Route::get('questions/import','QuestionController@qtnImportView');
        Route::post('questions/read-excel','QuestionController@readExcel');
        Route::match(['get','post'],'questions/view','QuestionController@showQuestion');
        Route::post('questions/submit-answers','QuestionController@submitAnswers');
        Route::post('read-count-down-time','QuestionController@showTimer');

         // manage schedules
         Route::get('schedules','ScheduleController@schedules');
         Route::get('schedules/{id}','ScheduleController@scheduledStudents');
         Route::match(['get','post'],'add-edit-schedule/{id?}','ScheduleController@addEditSchedule');
         Route::post('update-schedule-status', 'ScheduleController@updateScheduleStatus');
         Route::post('get-avail-qtn', 'ScheduleController@getAvailQtns');
         Route::get('download-results/{id}', 'ScheduleController@downloadResult');

         // users
         Route::get('users','UserController@users');
         Route::post('update-user-status','userController@updateUserStatus');

         ## roles and permissions
         Route::group(['middleware'=>['role:Super-Admin']], function(){
          Route::get('roles','RoleController@viewRoles');
          Route::get('permissions','RoleController@viewPermissions');
          Route::match(['get','post'],'add-edit-role/{id?}','RoleController@addEditRole');
          Route::match(['get','post'],'add-edit-permission/{id?}','RoleController@addEditPermission');
          Route::get('role-permission','RoleController@rolesPermission');
          Route::post('load-permissions','RoleController@loadPermissions');
          Route::post('change-role-permission','RoleController@changeRolePermission');
          ###
         Route::post('get-admin-roles','AdminController@getAdminRoles');
         Route::post('set-admin-roles','AdminController@setAdminRoles');
         Route::get('staff/assign-role/{id?}','AdminController@assignRole');
         Route::match(['get','post'],'add-edit-staff/{id?}','AdminController@addEditAdmin');

        }); ## end middleware

        Route::group(['middleware'=>['role:Super-Admin|Administrator']], function(){

          // manage students
        Route::match(['get','post'],'students','UserController@students');
        Route::get('add-new-student/{id?}','UserController@newStudentForm');
        Route::post('add-new-student','UserController@saveNewStudent');
        Route::get('students/edit/{id?}','UserController@addEditStudent');
        Route::get('students/import','UserController@userImportView');
        Route::post('students/read-excel','UserController@readExcel');
        Route::post('load-country-states','UserController@load_country_states');
        Route::post('load-state-cities','UserController@load_state_cities');

        // student / staff passport upload
        Route::post('upload-student-passport','UserController@upload_passport');
        Route::post('upload-staff-passport','AdminController@upload_passport');

        ##  Administrative Staff - only permitted
        Route::get('staff','AdminController@admins');
        Route::get('staff/import','AdminController@adminImportView');
        Route::post('staff/read-excel','AdminController@readExcel');

           ## ACADEMIC SETTINGS
         #####################################
         Route::get('acad-levels','AcademicController@academic_levels');
         Route::match(['get','post'],'add-edit-level/{id?}','AcademicController@addEditLevel');
         Route::match(['get','post'],'academic-calendar','AcademicController@edit_view_academic_calendar');
         Route::match(['get','post'],'student-course-registration-settings',
                 'AcademicController@set_student_course_registration_calendar');
         Route::match(['get','post'],'result-uploads-settings',
                 'AcademicController@result_uploads_settings');

         ## CLASSROOMS
         #############################
         Route::get('classrooms','ClassroomController@classrooms');
         Route::match(['get','post'],'add-edit-classroom/{id?}','ClassroomController@addEditClassRoom');
         Route::post('get-rooms-by-level','UserController@getRoomByLevel');

         ## PAYMENT / FINANCIAL MANAGEMENT
         ## setup-payment-types
        Route::match(['get','post'],'payment-items/{slug?}','PaymentController@payment_items');
        Route::match(['get','post'],'setup-payment-types/{id?}','PaymentController@setup_payment_types');
        Route::match(['get','post'],'payment-amounts-setup/{slug?}','PaymentController@payment_amounts_setup');
        Route::post('update-pay-item-status', 'PaymentController@payment_item_status_update');
        Route::post('update-pay-type-status', 'PaymentController@payment_type_status_update');
        Route::post('search-payment-amount-setup', 'PaymentController@search_payment_amount_setup');
        
        }); ## end middleware

         ##  Administrative Staff
         Route::get('my-profile','AdminController@adminProfile');
         Route::match(['get','post'],'reset-password','AdminController@manage_password');

         // MANAGE STUDENT ACTIVITIES BY ADMIN
          Route::match(['get','post'],'my-students','ActivityController@accessMyStudents');
          Route::match(['get','post'],'upload-results','ActivityController@uploadResults');
          Route::post('search-student-for-manual-result-upload','ActivityController@result_upload_manual_search');
          Route::post('search-student-for-bulk-result-upload','ActivityController@result_upload_bulk_search');
          Route::post('get-set-student-scores/','ActivityController@get_set_student_scores');
          Route::post('manually-save-student-score/','ActivityController@manually_save_student_scores');
          Route::get('my-students-results/','ActivityController@students_results_view');
          Route::get('student-per-term-result/{token}','ActivityController@view_student_per_term_result');
          Route::get('calculate-student-position/{token?}','ActivityController@calculate_student_position');
          Route::post('search-student-result-manually','ActivityController@search_student_result_manually');

          // Attendance management
          Route::get('take-class-attendance/','AttendanceController@attendance_view');
          Route::post('search-student-for-class-attendance','AttendanceController@student_search');
          Route::get('submit-class-attendance/{params}/{students?}','AttendanceController@submit_attendance');

          ## download manager
          Route::get('download-result-template/{token}','DownloadManager@import_result_template');

           ## Uploading Result
          Route::post('student-result/read-excel','UploadManager@read_excel_result');
          Route::get('student-result/upload-success','UploadManager@upload_success_message_view');


       });
});


// Students dashboard
 Route::prefix('/student')->namespace('App\Http\Controllers\Front')->group(function(){
      Route::group(['middleware'=>['student']],function(){
         Route::get('dashboard','StudentController@dashboard');
         Route::get('profile','StudentController@profile');
         Route::match(['get','post'],'course-registration','CourseRegController@start_reg');

      });
 });

require __DIR__.'/auth.php';


