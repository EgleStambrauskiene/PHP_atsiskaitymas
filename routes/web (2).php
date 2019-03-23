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
//Auth::routes();
// Because we don't use a full auth system, the following routes is enaught

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', function () {
    return view('customers.customers-front');
});

// Change locale
Route::post('/lang', function(Request $request) {
     session(['lang' => $request->input('lang')]);
     return redirect()->back();
})->name('lang');

// LoggedIn area
Route::middleware('auth')->group(function() {
    // Customers list
    Route::get('/customers', 'CustomerController@list')->name('customers.list');

    // Customers company filter form
    Route::post('/customers', 'CustomerController@list')->name('customers.list');

    // Customer add form
    Route::get('/customers/new', 'CustomerController@new')->name('customers.new');

    // Show customer
    Route::get('/customers/{id}/show', 'CustomerController@show')->where('id', '[0-9]+')->name('customers.show');

    // Customer edit form
    Route::get('/customers/{id}/edit', 'CustomerController@edit')->where('id', '[0-9]+')->name('customers.edit');

    // Delete customer
    Route::delete('/customers/trash', 'CustomerController@trash')->name('customers.trash');

    // Save edited customer
    Route::put('/customers/{id}/save', 'CustomerController@save')->where('id', '[0-9]+')->name('customers.save');

    // Save new customer
    Route::post('/customers/{id}/save', 'CustomerController@save')->where('id', '[0-9]+')->name('customers.save');
});

