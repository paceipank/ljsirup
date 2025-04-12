<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Sync;
use Illuminate\Support\Facades\Route;

Route::get('/', [Home::class,'home'])->name('home');
Route::get('/penyedia', [Home::class,'penyedia'])->name('penyedia');
Route::get('/swakelola', [Home::class,'swakelola'])->name('swakelola');
Route::post('/syncpenyedia',[Sync::class,'syncpenyedia'])->name('syncpenyedia');
Route::post('/syncswakelola',[Sync::class,'syncswakelola'])->name('syncswakelola');
Route::post('/syncsatker',[Sync::class,'syncsatker'])->name('syncsatker');
Route::get('/penyedia/export', [Home::class, 'penyediaExport'])->name('penyedia.export');