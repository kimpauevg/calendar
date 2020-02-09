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
    return view('welcome');
});

Route::get('/check/{word}','Auth\check\CheckController@check');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/good',function() {
    return 'hello there';
});
//Route::get('/calendar','Calendar\CalendarController@index')->middleware('auth');

//Route::post('/calendar/new-routine','Calendar\CalendarController@new');
Route::apiResource('/calendar','Calendar\CalendarController');
