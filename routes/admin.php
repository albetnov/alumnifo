<?php

use App\Http\Livewire\Admin\EditContact;
use App\Http\Livewire\Admin\IndexContact;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Request\RequestEditIndex;
use App\Http\Livewire\Request\RequestIndex;
use App\Http\Livewire\Users\AddUser;
use App\Http\Livewire\Users\EditUser;
use App\Http\Livewire\Users\IndexUsers;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:SuperAdmin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('users', IndexUsers::class)->name('users');
    Route::get('users/add', AddUser::class)->name('users.add');
    Route::get('users/edit/{user}', EditUser::class)->name('users.edit');
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('contact', IndexContact::class)->name('contact');
    Route::get('contact/edit/{publicContact}', EditContact::class)->name('contact.edit');
    Route::get('request', RequestIndex::class)->name('request');
    Route::get('request/edit', RequestEditIndex::class)->name('request.edit');
});
