<?php


use App\Http\Livewire\ClassRoom\Index;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'classroom'], function () {
    Route::get('/', Index::class);
});
