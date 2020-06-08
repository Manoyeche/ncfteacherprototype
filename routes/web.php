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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin');
});

Route::prefix('/teacher')->group(function () {
    Route::get('/', 'Teacher\TeacherController@index')->name('teacher');
    
    Route::prefix('/student')->group(function () {
        Route::get('/', 'Teacher\StudentController@list')->name('teacher.student.list');
        Route::get('/{id}', 'Teacher\StudentController@viewStudent')->name('teacher.student.view');

        Route::post('/add-student', 'Teacher\StudentController@addStudent')->name('teacher.student.add');
    });
});

Route::prefix('/student')->group(function () {
    Route::get('/', 'Student\StudentController@index')->name('student');
});