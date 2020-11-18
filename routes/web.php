<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'Admin\Dashboard@index')->name('dashboard');
    //user
    Route::get('/manager-user/data', 'Admin\ManagerUserController@data')->name('manager-user.data');
    //class/student
    Route::get('/manager-class/data', 'Admin\ManagerClassController@data')->name('manager-class.data');
    Route::get('/manager-class/{title}/student', 'Admin\ManagerClassController@showStudent')->name('manager-class.show-student');
    Route::get('/manager-class/{title}/student/data', 'Admin\ManagerClassController@dataStudent')->name('manager-class.data-student');
    Route::get('/manager-class/{title}/student/create/data', 'Admin\ManagerClassController@dataNotStudent')->name('manager-class.data-not-student');
    Route::get('/manager-class/{title}/student/create', 'Admin\ManagerClassController@createStudent')->name('manager-class.create-student');
    Route::get('/manager-class/{title}/student/create/{student}', 'Admin\ManagerClassController@storeStudent')->name('manager-class.store-student');
    Route::get('/manager-class/{title}/student/destroy/{student}', 'Admin\ManagerClassController@destroyStudent')->name('manager-class.destroy-student');
    //class/course
    Route::get('/manager-class/{title}/course', 'Admin\ManagerClassController@showCourse')->name('manager-class.show-course');
    Route::get('/manager-class/{title}/course/data', 'Admin\ManagerClassController@dataCourse')->name('manager-class.data-course');
    Route::get('/manager-class/{title}/course/create', 'Admin\ManagerClassController@createCourse')->name('manager-class.create-course');
    Route::get('/manager-class/{title}/course/create/data', 'Admin\ManagerClassController@dataNotCourse')->name('manager-class.data-not-course');
    Route::get('/manager-class/{title}/course/create/{course}', 'Admin\ManagerClassController@storeCourse')->name('manager-class.store-course');
    //class/course/teacher
    Route::get('/manager-class/{title}/course/{course}/teacher/edit/{id}', 'Admin\ManagerClassController@editTeacher')->name('manager-class.edit-teacher');
    Route::put('/manager-class/{title}/course/{course}/teacher/edit/{id}', 'Admin\ManagerClassController@updateTeacher')->name('manager-class.update-teacher');
    //class
    Route::resource('manager-class', 'Admin\ManagerClassController');

    Route::get('manager-student/downloadTemplateExcel', 'Admin\ManagerStudentController@downloadTemplateExcel')->name('manager-student.downloadTemplateExcel');
    Route::get('manager-student/data', 'Admin\ManagerStudentController@data')->name('manager-student.data');
    Route::put('manager-student/{manager_student}/update', 'Admin\ManagerStudentController@updateInfoStudent')->name('manager-student.update-info-student');
    Route::post('manager-student/importStudent', 'Admin\ManagerStudentController@importStudent')->name('manager-student-importStudent');
    Route::post('manager-student/studentInfo/{id}','Admin\ManagerStudentController@updateInfoStudent')->name('manager-student.updateInfoStudent');
    Route::resource('manager-student', 'Admin\ManagerStudentController');

    Route::get('manager-parent/downloadTemplateExcel', 'Admin\ManagerParentController@downloadTemplateExcel')->name('manager-parent.downloadTemplateExcel');
    Route::get('manager-parent/data', 'Admin\ManagerParentController@data')->name('manager-parent.data');
    Route::put('manager-parent/{manager_parent}/update', 'Admin\ManagerParentController@updateInfoParent')->name('manager-parent.update-info-parent');
    Route::post('manager-parent/importParent', 'Admin\ManagerParentController@importParent')->name('manager-parent-importParent');
    Route::resource('manager-parent', 'Admin\ManagerParentController');


    Route::resource('manager-user', 'Admin\ManagerUserController');


    Route::get('profile/edit','ProfileController@edit')->name('profile.edit');
    Route::post('profile/edit','ProfileController@update')->name('profile.update');

    Route::get('manager-course-school/data', 'Admin\ManagerCourseSchoolController@data')->name('manager-course-school.data');
    Route::resource('manager-course-school', 'Admin\ManagerCourseSchoolController');

});

Route::name('teacher.')->prefix('teacher')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'Teacher\Dashboard@index')->name('dashboard');
    Route::get('/manager-module/data','Teacher\ManagerModuleController@data')->name('manager-module.data');
    Route::resource('manager-module', 'Teacher\ManagerModuleController');


    Route::get('profile/edit','ProfileController@edit')->name('profile.edit');
    Route::post('profile/edit','ProfileController@update')->name('profile.update');

    Route::get('manager-class/{title}/course/{course}', 'Teacher\ManagerClassController@index')->name('manager-class.index');
    Route::get('manager-class/{title}/course/{course}/data', 'Teacher\ManagerClassController@dataScoreClassCourse')->name('manager-class.data');
    Route::get('manager-class/{title}/course/{course}/show', 'Teacher\ManagerClassController@showScore')->name('manager-class.show');
//    Route::get('manager-class/{title}/course/{course}/data', 'Teacher\ManagerClassController@dataScoreClassCourse')->name('manager-class.data-final');
//    Route::get('manager-class/{title}/course/{course}/show', 'Teacher\ManagerClassController@showScore')->name('manager-class.show-final');

    Route::get('manager-class/{title}/course/{course}/module/data-not-module', 'Teacher\ManagerClassController@dataNotModule')->name('manager-class.data-not-module');
    Route::get('manager-class/{title}/course/{course}/module/add-module/{id}', 'Teacher\ManagerClassController@addModule')->name('manager-class.add-module');
    Route::get('manager-class/{title}/course/{course}/module/data-module', 'Teacher\ManagerClassController@dataModule')->name('manager-class.data-module');
    Route::get('manager-class/{title}/course/{course}/module/create', 'Teacher\ManagerClassController@createModule')->name('manager-class.create-module');
    Route::get('manager-class/{title}/course/{course}/module/show', 'Teacher\ManagerClassController@showModule')->name('manager-class.show-module');
    Route::post('manager-class/{title}/course/{course}/module/create', 'Teacher\ManagerClassController@storeModule')->name('manager-class.store-module');
    Route::get('manager-class/{title}/course/{course}/module/edit/{id}', 'Teacher\ManagerClassController@editModule')->name('manager-class.edit-module');
    Route::put('manager-class/{title}/course/{course}/module/edit/{id}', 'Teacher\ManagerClassController@updateModule')->name('manager-class.update-module');
    Route::get('manager-class/{title}/course/{course}/module/destroy/{id}', 'Teacher\ManagerClassController@destroyModule')->name('manager-class.destroy-module');

    Route::get('manager-class/{title}/course/{course}/mission/show/{id}', 'Teacher\ManagerClassController@showMission')->name('manager-class.show-mission');
    Route::get('manager-class/{title}/course/{course}/mission/data-mission', 'Teacher\ManagerClassController@dataMission')->name('manager-class.data-mission');
    Route::get('manager-class/{title}/course/{course}/mission/create', 'Teacher\ManagerClassController@createMission')->name('manager-class.create-mission');
    Route::post('manager-class/{title}/course/{course}/mission/create', 'Teacher\ManagerClassController@storeMission')->name('manager-class.store-mission');
    Route::get('manager-class/{title}/course/{course}/mission/edit/{id}', 'Teacher\ManagerClassController@editMission')->name('manager-class.edit-mission');
    Route::put('manager-class/{title}/course/{course}/mission/edit/{id}', 'Teacher\ManagerClassController@updateMission')->name('manager-class.update-mission');
    Route::get('manager-class/{title}/course/{course}/mission/destroy/{id}', 'Teacher\ManagerClassController@destroyMission')->name('manager-class.destroy-mission');

    Route::get('manager-class/{title}/course/{course}/mission/{id}/data-mission-detail', 'Teacher\ManagerClassController@dataMissionDetail')->name('manager-class.data-mission-detail');
    Route::get('manager-class/{title}/course/{course}/mission/{id}/mission-detail/show/{detail}', 'Teacher\ManagerClassController@showMissionDetail')->name('manager-class.show-mission-detail');
    Route::get('manager-class/{title}/course/{course}/mission/{id}/mission-detail/create', 'Teacher\ManagerClassController@createMissionDetail')->name('manager-class.create-mission-detail');
    Route::post('manager-class/{title}/course/{course}/mission/{id}/mission-detail/create', 'Teacher\ManagerClassController@storeMissionDetail')->name('manager-class.store-mission-detail');
    Route::get('manager-class/{title}/course/{course}/mission/{id}/mission-detail/edit/{detail}', 'Teacher\ManagerClassController@editMissionDetail')->name('manager-class.edit-mission-detail');
    Route::put('manager-class/{title}/course/{course}/mission/{id}/mission-detail/edit/{detail}', 'Teacher\ManagerClassController@updateMissionDetail')->name('manager-class.update-mission-detail');
    Route::get('manager-class/{title}/course/{course}/mission/{id}/mission-detail/destroy/{detail}', 'Teacher\ManagerClassController@destroyMissionDetail')->name('manager-class.destroy-mission-detail');

    Route::get('manager-class/{title}/course/{course}/mission/score/{id}/data','Teacher\ManagerClassController@dataMissionScore')->name('manager-class.data-mission-score');
    Route::get('manager-class/{title}/course/{course}/mission/score/{id}','Teacher\ManagerClassController@indexMissionScore')->name('manager-class.index-mission-score');
    Route::get('manager-class/{title}/course/{course}/mission/score/{id}/show/{user}','Teacher\ManagerClassController@showMissionScore')->name('manager-class.show-mission-score');
    Route::post('manager-class/{title}/course/{course}/mission/score/{id}/store/{user}','Teacher\ManagerClassController@storeMissionScore')->name('manager-class.store-mission-score');


    Route::get('manager-talent-class','Teacher\ManagerTalentClass@index')->name('manager-talent-class.index');
    Route::get('manager-talent-class/data','Teacher\ManagerTalentClass@data')->name('manager-talent-class.data');
    Route::get('manager-talent-class/create','Teacher\ManagerTalentClass@create')->name('manager-talent-class.create');
    Route::post('manager-talent-class/store','Teacher\ManagerTalentClass@store')->name('manager-talent-class.store');

    Route::get('manager-talent-class/tkd/create','Teacher\ManagerTalentClass@createTkd')->name('manager-talent-class.create-tkd');
    Route::post('manager-talent-class/tkd/store','Teacher\ManagerTalentClass@storeTkd')->name('manager-talent-class.store-tkd');

    Route::get('manager-talent-class/ci/create','Teacher\ManagerTalentClass@createCi')->name('manager-talent-class.create-ci');
    Route::post('manager-talent-class/ci/store','Teacher\ManagerTalentClass@storeCi')->name('manager-talent-class.store-ci');

    Route::get('manager-talent-class/exam/tkd/{id}/{number}','Teacher\ManagerTalentClass@showExamTkd')->name('manager-talent-class.exam-tkd-show');
    Route::get('manager-talent-class/exam/tkd/{id}/{number}/end','Teacher\ManagerTalentClass@storeExamTkd')->name('manager-talent-class.exam-tkd-store');

    Route::get('manager-talent-class/exam/tkd2/{id}/{number}','Teacher\ManagerTalentClass@showExamTkd2')->name('manager-talent-class.exam-tkd2-show');
    Route::get('manager-talent-class/exam/tkd2/{id}/{number}/end','Teacher\ManagerTalentClass@storeExamTkd2')->name('manager-talent-class.exam-tkd2-store');

    Route::get('manager-talent-class/exam/tkd3/{id}/{number}','Teacher\ManagerTalentClass@showExamTkd3')->name('manager-talent-class.exam-tkd3-show');
    Route::get('manager-talent-class/exam/tkd3/{id}/{number}/end','Teacher\ManagerTalentClass@storeExamTkd3')->name('manager-talent-class.exam-tkd3-store');

    Route::get('manager-talent-class/exam/tkd4/{id}/{number}','Teacher\ManagerTalentClass@showExamTkd4')->name('manager-talent-class.exam-tkd4-show');
    Route::get('manager-talent-class/exam/tkd4/{id}/{number}/end','Teacher\ManagerTalentClass@storeExamTkd4')->name('manager-talent-class.exam-tkd4-store');

    Route::get('manager-talent-class/exam/ci/{id}/{number}','Teacher\ManagerTalentClass@showExamCi')->name('manager-talent-class.exam-ci-show');
    Route::post('manager-talent-class/exam/ci/{id}/{number}','Teacher\ManagerTalentClass@storeExamCI')->name('manager-talent-class.exam-ci-store');
});


Route::name('student.')->prefix('student')->middleware('auth')->group(function () {

    Route::get('profile/edit','ProfileController@edit')->name('profile.edit');
    Route::post('profile/edit','ProfileController@update')->name('profile.update');

    Route::get('dashboard', 'Student\Dashboard@index')->name('dashboard');
    Route::get('manager-class/{title}','Student\ManagerClassController@index')->name('manager-class');
    Route::get('manager-class/{title}/detail-module/{id}','Student\ManagerClassController@showDetailModule')->name('manager-class.show-detail-module');
    Route::get('manager-class/{title}/detail-mission/{id}','Student\ManagerClassController@showMission')->name('manager-class.show-mission');
    Route::get('manager-class/{title}/detail-mission/{id}/start','Student\ManagerClassController@startMission')->name('manager-class.start-mission');
    Route::get('manager-class/{title}/detail-mission/{id}/{number}','Student\ManagerClassController@showDetailMission')->name('manager-class.show-detail-mission');
    Route::post('manager-class/{title}/detail-mission/{id}/{number}','Student\ManagerClassController@storeDetailMission')->name('manager-class.store-detail-mission');
//    Route::get('manager-class/{title}/data-module-full','Student\ManagerClassController@dataModule')->name('manager-class.data-module');
//    Route::get('manager-class/{title}/data-mission-full','Student\ManagerClassController@dataMission')->name('manager-class.data-mission');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
