<?php

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
    return view('auth.login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('subject', 'SubjectController');

Route::resource('logfile', 'LogFileController');

Route::resource('contentfile', 'ContentFileController');

Route::resource('descriptionfile', 'DescriptionFileController');

Route::resource('section', 'SectionController');

Route::resource('department', 'DepartmentController');

Route::resource('semester', 'SemesterController');

Route::resource('teacher', 'TeacherController');

Route::resource('student', 'StudentController');

Route::resource('assignsubject', 'AssignSubjectController');

Route::resource('enrollsubject', 'EnrollSubjectController');

Route::resource('assignment', 'AssignmentController');

Route::resource('uploadassignment', 'UploadAssignmentController');

Route::resource('quiz', 'QuizController');

Route::resource('quizanswer', 'QuizAnswerController');

Route::resource('question', 'QuestionController');

Route::resource('uploadexam', 'ExamController');


Route::get('index', function () {
    return view('index');
});

Route::get('generatequiz', function () {
    return view('generateQuiz');
});
Route::get('generatequestion', function () {
    return view('generateQuestion');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('add-section/fetch', 'SemesterController@fetch')->name('semester.fetch');
Route::post('add-subject/fetch', 'SectionController@fetch')->name('section.fetch');
Route::post('add-teacher/fetch', 'TeacherController@fetch')->name('teacher.fetch');
Route::post('add-logfile/fetch', 'SubjectController@fetch')->name('subject.fetch');
// Route::post('show-quiz/fetch', 'QuizAnswerController@fetch')->name('quiz.fetch');

Route::post('show-student-quiz/fetch', 'StudentController@fetch')->name('student.fetch');
Route::post('show-assignment/fetch', 'UploadAssignmentController@fetch')->name('assignment.fetch');
Route::post('show-quiz/fetch', 'QuizController@fetch')->name('quiz.fetch');

Route::get('show-upload-assignment/{id}', 'UploadAssignmentController@showUploadedAssignment')->name('uploadassignment.showUploadedAssignment');
Route::get('show-assignment-marks/{id}', 'UploadAssignmentController@showAssignmentMarks')->name('uploadassignment.showAssignmentMarks');

Route::get('select-subject/{id}', 'ExamController@selectSubject')->name('uploadexam.selectSubject');

Route::get('show-assign-subject/{id}', 'QuizController@showAssignSubject')->name('quiz.showAssignSubject');


Route::post('add-teacher/assignlogin','TeacherController@assignLogin')->name('teacher.assignLogin');
Route::post('add-student/assignlogin','StudentController@assignLogin')->name('student.assignLogin');

Route::get('show-assignment/assignment/{id}','AssignmentController@showAssignment')->name('assignment.showAssignment');
Route::get('show-subject/student/{id}','StudentController@showSubject')->name('student.showSubject');
Route::get('show-quiz-subject/student/{id}','QuizController@showSubject')->name('quiz.showSubject');

Route::get('change-password','TeacherController@changePassword')->name('changePasword');
Route::post('update-password','TeacherController@updatePassword')->name('updatePasword');

