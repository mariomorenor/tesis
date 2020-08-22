<?php



Route::get('/', function(){
        // $temp = DB::table('temperaturas')->where('dia',1)->first(['tempMin as Min','tempMax as Max']);
        // $tempMax = DB::table('temperaturas')->where('dia',1)->get(['tempMax']);
        // return DB::table('temperaturas')->where('dia',1)->value('id');
        return view('index');
    });

    Route::post('login','HomeController@login');
    Route::post('logout','HomeController@logout')->name('logout');
    
    Route::get('user', 'HomeController@getUser');  
    Route::get('check', 'HomeController@check');

        // Control
    Route::group(['prefix' => 'control'], function () {
        Route::get('checkControlLote','HomeController@checkControlLote');
        Route::post('store_lote', 'LoteController@store')->name('store_lote');
        Route::get('show_control_lote/{lote}', 'LoteController@showLoteControl');
        Route::post('initControl/{lote}', 'LoteController@initControl');
        Route::get('isActive', 'LoteController@isActive');
        Route::get('temp','LoteController@temp');
        // Route::get('/', 'LoteController@controlLotes')->name('control.index');
        // Route::delete('delete_lote/{lote}', 'LoteController@delete')->name('delete_lote');
        // Route::post('select_lote/{lote}','LoteController@update')->name('select_lote');

    });

      //******************Rutas de Usuario****************
    Route::get('getusers', 'UserController@getUsers');
    Route::get('roles','UserController@roles');
    Route::resource('users', 'UserController');    


    //******************Rutas de Lote ******************/

    Route::get('getLotes','LoteController@getLotes');
    Route::get('reportesLote','DailyReportController@mostrarLote');
    Route::resource('reportes','DailyReportController');

// Auth::routes(['register'=>false, 'confirm'=>false,'reset'=>false]);

// Route::middleware(['auth'])->group(function () {

//     Route::get('/', function () {
//         return redirect()->route('control.index');
//     });
    
//     //******************Rutas Lote********************

//     // Production
//     Route::group(['prefix' => 'production'], function () {
//         Route::get('/','LoteController@productionLotes')->name('production.index');
//         Route::get('getLotes','LoteController@getLotes');
//         Route::get('/lote_details/{lote}','LoteController@show')->name('production.lote_details');


//     });

//     // Control
//     Route::group(['prefix' => 'control'], function () {
//         Route::get('/', 'LoteController@controlLotes')->name('control.index');
//         Route::post('store_lote', 'LoteController@store')->name('store_lote');
//         Route::delete('delete_lote/{lote}', 'LoteController@delete')->name('delete_lote');
//         Route::post('select_lote/{lote}','LoteController@update')->name('select_lote');

//     });
    
//     //******************Rutas de Usuario****************
//     Route::get('getusers', 'UserController@getUsers');
//     Route::resource('users', 'UserController');    

// });