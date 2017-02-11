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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    #adminlte_routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/users/get-users', 'UsersController@getUsers')->name('users.getUsers');
        Route::post('/users/{user}/banned', 'UsersController@banned')->name('users.banned');
        Route::resource('/users', 'UsersController');

        Route::get('/family-cards/get-family-cards', 'FamilyCardsController@getFamilyCards')->name('family_cards.getFamilyCards');
        Route::resource('/family-cards', 'FamilyCardsController', [
            'names' => resourceNames('family_cards')
        ]);
    });
});
