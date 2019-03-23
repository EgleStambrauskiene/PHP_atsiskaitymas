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
//COMMENTED!!
// Route::get('/', function () {
//     return view('welcome');
// });

//COPIED!!
//Auth::routes();
// Because we don't use a full auth system, the following routes is enaught
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
    // Students list
    Route::get('/students', 'StudentController@list')->name('students.list');

    // Lectures list
    Route::get('/lectures', 'LectureController@list')->name('lectures.list');

    // Customers company filter form
    // Route::post('/customers', 'CustomerController@list')->name('customers.list');

    // Student add form
    Route::get('/students/new', 'StudentController@new')->name('students.new');

    // Show student
    Route::get('/students/{id}/show', 'StudentController@show')->where('id', '[0-9]+')->name('students.show');

    // Student edit form
    Route::get('/students/{id}/edit', 'StudentController@edit')->where('id', '[0-9]+')->name('students.edit');

    // Delete student
    Route::delete('/students/trash', 'StudentController@trash')->name('students.trash');

    // Save edited student
    Route::put('/students/{id}/save', 'StudentController@save')->where('id', '[0-9]+')->name('students.save');

    // Save new student
    Route::post('/students/{id}/save', 'StudentController@save')->where('id', '[0-9]+')->name('students.save');
});

