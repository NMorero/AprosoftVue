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
    return view('nodeManager');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('testing');
});

Route::get('/canvas', function () {
    return view('canvasMap');
});

Route::get('/light', function () {
    return view('lightPage');
});


Route::get('/pointPlanner', function () {
    return view('pointPlanner');
});

Route::get('/getJsonGoals', function(){
    $string = file_get_contents("json/goalsPointPlanner.json");
    $json_a = json_decode($string, true);
    return $json_a;
});

Route::post('/setJsonGoals', 'HomeController@setGoalsPointPlanner');

Route::get('/getTasks', 'HomeController@getTasks');

Route::get('/getMissions', 'HomeController@getMissions');

Route::get('/saveLog', 'HomeController@saveLog');
