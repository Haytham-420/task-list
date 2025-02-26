<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $name = 'Haytham';

    //first method
    //return view('about',['name'=> $name] );

    //second method
    // return view('about')->with('name', $name);

    $departments = [
        '01' => 'Technical',
        '02' => 'Financial',
        '03' => 'Sales',
    ];

    //third method
    return view('about', compact('name', 'departments'));
});

// we can use the same route twice IF we use a different method each
//time (eg. get, post), or it will be overwritten by the latest in the php file

Route::post('/about', function () {
    $name = $_POST['name'];
    $departments = [
        '01' => 'Technical',
        '02' => 'Financial',
        '03' => 'Sales',
    ];

    return view('about', compact('name', 'departments'));
});

// Tasks Routes
Route::get('tasks', [TaskController::class, 'index']);

Route::post('task/create', [TaskController::class, 'create']);

Route::post('task/delete/{id}', [TaskController::class, 'destroy']);

Route::post('task/edit/{id}', [TaskController::class, 'edit']);

Route::post('task/update', [TaskController::class, 'update']);

Route::get('app', function () {
    return view('layouts.app');
});

// Users Routes
Route::get('users', [UserController::class, 'index']);

Route::post('user/create', [UserController::class, 'create']);

Route::post('user/delete/{id}', [UserController::class, 'destroy']);

Route::post('user/edit/{id}', [UserController::class, 'edit']);

Route::post('user/update', [UserController::class, 'update']);
