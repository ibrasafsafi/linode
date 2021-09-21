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

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('instances', \App\Http\Controllers\LinodeInstance::class);
Route::get('accounts', \App\Http\Livewire\ListAccounts::class)->name('accounts.index');
Route::get('instances', \App\Http\Livewire\ListInstances::class)->name('instances.index');
Route::get('{accountId}/instances/show/{linodeId}', \App\Http\Livewire\ShowInstance::class)->name('instances.show');
//Route::post('instances/{linodeId}/reboot', [\App\Http\Controllers\LinodeInstance::class, 'reboot'])->name('reboot-instance');
Route::get('{accountId}/instances/manage/{linodeId?}/{action?}', \App\Http\Livewire\CreateInstances::class)
    ->name('instances.manage');
