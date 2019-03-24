<?php
// We need request for locale changer route
use Illuminate\Http\Request;

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

//COPIED!!
//Auth::routes();
// Because we don't use a full auth system, the following routes is enough
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//COPIED!!
Route::get('/', function () {
    return view('college.college-front');
});

//COPIED!!
// Change locale
Route::post('/lang', function(Request $request) {
    session(['lang' => $request->input('lang')]);
    return redirect()->back();
})->name('lang');

// LoggedIn area
Route::middleware('auth')->group(function() {
    // List: students, lectures, grades.
    Route::get('/students', 'StudentController@list')->name('students.list');
    Route::get('/lectures', 'LectureController@list')->name('lectures.list');
    Route::get('/grades', 'GradeController@list')->name('grades.list');

    // Customers company filter form
    // Route::post('/customers', 'CustomerController@list')->name('customers.list');

    // Add form: student, lecture.
    Route::get('/students/new', 'StudentController@new')->name('students.new');
    Route::get('/lectures/new', 'LectureController@new')->name('lectures.new');

    // Show: student, lecture.
    Route::get('/students/{id}/show', 'StudentController@show')->where('id', '[0-9]+')->name('students.show');
    Route::get('/lectures/{id}/show', 'LectureController@show')->where('id', '[0-9]+')->name('lectures.show');

    // Edit form: student, lecture.
    Route::get('/students/{id}/edit', 'StudentController@edit')->where('id', '[0-9]+')->name('students.edit');
    Route::get('/lectures/{id}/edit', 'LectureController@edit')->where('id', '[0-9]+')->name('lectures.edit');

    // Delete: student, lecture.
    Route::delete('/students/trash', 'StudentController@trash')->name('students.trash');
    Route::delete('/lectures/trash', 'LectureController@trash')->name('lectures.trash');
    Route::delete('/grades/trash', 'LectureController@trash')->name('lectures.trash');

    // Save edited: student, lecture.
    Route::put('/students/{id}/save', 'StudentController@save')->where('id', '[0-9]+')->name('students.save');
    Route::put('/lectures/{id}/save', 'LectureController@save')->where('id', '[0-9]+')->name('lectures.save');

    // Save new: student, lecture.
    Route::post('/students/{id}/save', 'StudentController@save')->where('id', '[0-9]+')->name('students.save');
    Route::post('/lectures/{id}/save', 'LectureController@save')->where('id', '[0-9]+')->name('lectures.save');
});

