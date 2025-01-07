<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Filament\Http\Middleware\Authenticate;
use Filament\Facades\Filament;
use Filament\Pages\Page;




// Home Route
Route::get('/', function () {
    return view('welcome');
});




