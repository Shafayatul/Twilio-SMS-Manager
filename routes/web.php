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
    return Redirect::to(url('/login'));
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();


Route::group(['middleware' => ['auth']], function() {

    /**
    * only admin
    */
        Route::group(['middleware' => ['role:Admin']], function () {
        Route::post('/admin/assignRole',  'RoleController@assignRole');
        Route::resource('/admin/role',  'RoleController');

        // History
        Route::resource('histories', 'HistoriesController');
        Route::get('/history/index','HistoriesController@index')->name('history.index');
        Route::get('/clear-history','HistoriesController@truncatehistoriesTable');

        // CSV
        Route::resource('csv', 'CSVsController');
        Route::post('/store/csv','CSVsController@csv_store');
        Route::post('/ajax/send-group-sms', 'CSVsController@send_group_sms');
        Route::post('/ajax/send-individual-sms', 'CSVsController@send_individual_sms');
        Route::post('/ajax/send-all-sms', 'CSVsController@send_all_sms');
        Route::get('group_list','CSVsController@csv_group_list');
        Route::get('manual','CSVsController@manualUploadView');        
        Route::post('/manual-csv','CSVsController@manualUpload');
        Route::get('/csv-group-delete/{group}','CSVsController@deleteGroup');
        Route::get('/groupdata-view/{group}','CSVsController@GroupDataView');
        Route::get('/clear-database','CSVsController@truncateCsvsTable');
  
    });


    /**
    * All
    */
    Route::group(['middleware' => ['role:Admin|Teacher|Volunteer']], function () {
        Route::post('/update-password', 'UsersController@update_password');
        Route::get('/update-password', 'UsersController@show_update_password');
    });


});

Route::resource('importers', 'ImportersController');