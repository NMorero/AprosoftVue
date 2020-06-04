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

Route::get('/getTasks', function () {
    $jsonTaskFile = file_get_contents("json/tasks.json");
    $taskData = json_decode($jsonTaskFile, true);
    return $taskData;
});

Route::get('/saveLog', 'HomeController@saveLog');
