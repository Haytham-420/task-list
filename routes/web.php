<?php

use Illuminate\Support\Facades\Route;

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

Route::get('tasks',function () {
    return view('tasks');
});

Route::post('create',function () {
    $task_name = $_POST['name'];
    DB::table('tasks')->insert(['name'=> $task_name]);
    return view('tasks');
});
