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
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function () {
    #adminlte_routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');
        Route::get('/users/get-users', 'UsersController@getUsers')->name('users.getUsers');
        Route::post('/users/{user}/banned', 'UsersController@banned')->name('users.banned');
        Route::post('/users/{user}/unbanned', 'UsersController@unbanned')->name('users.unbanned');
        Route::resource('/users', 'UsersController');

        Route::get('/family-cards/kadus/{kadus}', 'FamilyCardsController@showKadus')->name('family_cards.showKadus');
        Route::get('/family-cards/kadus/get-data/{kadus}', 'FamilyCardsController@getByKadus')->name('family_cards.getByKadus');
        Route::get('/family-cards/get-family-cards', 'FamilyCardsController@getFamilyCards')->name('family_cards.getFamilyCards');
        Route::resource('/family-cards', 'FamilyCardsController', [
            'names' => resourceNames('family_cards'),
            'parameters' => [
                'family-cards' => 'familyCard',
            ],
        ]);

        Route::get('/residents/disabilities/{disability}', 'ResidentsController@showDisability')->name('residents.showDisabilityData');
        Route::get('/residents/disabilities/get-data/{disability}', 'ResidentsController@getDisabilityData')->name('residents.getDisabilityData');
        Route::get('/residents/education/{education}', 'ResidentsController@showEducation')->name('residents.showEducationData');
        Route::get('/residents/education/get-data/{education}', 'ResidentsController@getEducationData')->name('residents.getEducationData');
        Route::get('/residents/jobs/{job}', 'ResidentsController@showJob')->name('residents.showJobData');
        Route::get('/residents/jobs/get-data/{job}', 'ResidentsController@getJobData')->name('residents.getJobData');
        Route::get('/residents/partition/{partition}', 'ResidentsController@showPartition')->name('residents.show_partition');
        Route::get('/residents/partition/get-data/{partition}', 'ResidentsController@getPartitionData')->name('residents.getPartitionData');
        Route::get('/residents/men-lists', 'ResidentsController@menLists')->name('residents.men_lists');
        Route::get('/residents/women-lists', 'ResidentsController@womenLists')->name('residents.women_lists');
        Route::get('/residents/get-residents', 'ResidentsController@getResidents')->name('residents.getResidents');
        Route::get('/residents/get-men-residents', 'ResidentsController@getMenResidents')->name('residents.getMenResidents');
        Route::get('/residents/get-women-residents', 'ResidentsController@getWomenResidents')->name('residents.getWomenResidents');
        Route::resource('/residents', 'ResidentsController');

        Route::resource('/settings', 'SettingsController', ['only' => ['index']]);

        Route::get('/education/get-education', 'EducationController@getEducation')->name('education.getEducation');
        Route::resource('/education', 'EducationController');

        Route::get('/jobs/get-jobs', 'JobsController@getJobs')->name('jobs.getJobs');
        Route::resource('/jobs', 'JobsController');

        Route::get('/disabilities/get-disabilities', 'DisabilitiesController@getDisabilities')->name('disabilities.getDisabilities');
        Route::resource('/disabilities', 'DisabilitiesController');

        Route::get('/provinces/get-provinces', 'ProvincesController@getProvinces')->name('provinces.getProvinces');
        Route::resource('/provinces', 'ProvincesController');

        Route::get('/districts/get-districts', 'DistrictsController@getDistricts')->name('districts.getDistricts');
        Route::resource('/districts', 'DistrictsController');

        Route::get('/sub-districts/get-sub-districts', 'SubDistrictsController@getSubDistricts')->name('sub_districts.getSubDistricts');
        Route::resource('/sub-districts', 'SubDistrictsController', [
            'names' => resourceNames('sub_districts'),
            'parameters' => [
                'sub-districts' => 'subDistrict',
            ],
        ]);

        Route::get('/villages/get-villages', 'VillagesController@getVillages')->name('villages.getVillages');
        Route::resource('/villages', 'VillagesController');

        // Route::get('/surats/pindah-datang/{familyCard}', 'PrintController@createSuratPindahDatang')->name('surats.pindah_datang');
    });

    Route::group(['prefix' => 'api'], function () {
        Route::get('/residents', 'Api\ResidentsApiController@index');
    });
});
