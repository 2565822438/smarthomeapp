<?php

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

Route::get('/pub', function () {

    $data = [
        'name' => 'qing',
        'age' => 18
    ];
    $res = PhpMqtt\Client\Facades\MQTT::publish('testtopic', json_encode($data));
    view('layouts.app');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/smarthome', function () {
    
    return view('smarthome');
});
//获取文件路径
require __DIR__.'/auth.php';
