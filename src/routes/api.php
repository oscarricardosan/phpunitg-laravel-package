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
});
