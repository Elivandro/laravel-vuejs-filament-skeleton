<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', fn(): View => View('welcome'))->name('welcome');
