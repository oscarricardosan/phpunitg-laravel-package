<?php

/*
|--------------------------------------------------------------------------
| Routes to PhpunitG
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix'=> 'phpunitg'], function(){
    Route::get('getTests', 'Oscarricardosan\PhpunitgLaravel\Controllers\PhpunitgController@getTests')
        ->name('PhpunitG.GetTests');

    Route::get('runMethod', 'Oscarricardosan\PhpunitgLaravel\Controllers\PhpunitgController@runMethod')
        ->name('PhpunitG.RunMethod');
});