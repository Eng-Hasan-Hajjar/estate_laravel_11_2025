<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->get('/user', function () {
        return ['name' => 'John Doe']; // مثال بسيط للرد
    });
