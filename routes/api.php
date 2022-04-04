<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Areas Routes */
Route::get('/areas', 'AreaController@showAreas');