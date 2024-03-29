<?php

use App\Http\Livewire\Tables\Kerja\AddKerja;
use App\Http\Livewire\Tables\Kerja\EditKerja;
use App\Http\Livewire\Tables\Kerja\IndexKerja;
use App\Http\Livewire\Tables\KerjaKuliah\AddKerjaKuliah;
use App\Http\Livewire\Tables\KerjaKuliah\EditKerjaKuliah;
use App\Http\Livewire\Tables\KerjaKuliah\IndexKerjaKuliah;
use App\Http\Livewire\Tables\Kuliah\AddKuliah;
use App\Http\Livewire\Tables\Kuliah\EditKuliah;
use App\Http\Livewire\Tables\Kuliah\IndexKuliah;
use App\Http\Livewire\Tables\MencariKerja\AddMencariKerja;
use App\Http\Livewire\Tables\MencariKerja\EditMencariKerja;
use App\Http\Livewire\Tables\MencariKerja\IndexMencariKerja;
use App\Http\Livewire\Tables\Usaha\AddUsaha;
use App\Http\Livewire\Tables\Usaha\EditUsaha;
use App\Http\Livewire\Tables\Usaha\IndexUsaha;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'table.', 'prefix' => 'table'], function () {
    Route::get('kerja', IndexKerja::class)->middleware('role_or_permission:SuperAdmin|viewKerja')->name('kerja.index');
    Route::get('kerja/add', AddKerja::class)->middleware('role_or_permission:SuperAdmin|addKerja')->name('kerja.add');
    Route::get('kerja/edit/{kerja}', EditKerja::class)->middleware('role_or_permission:SuperAdmin|editKerja')->name('kerja.edit');

    Route::get('kuliah', IndexKuliah::class)->middleware('role_or_permission:SuperAdmin|viewKuliah')->name('kuliah.index');
    Route::get('kuliah/add', AddKuliah::class)->middleware('role_or_permission:SuperAdmin|addKuliah')->name('kuliah.add');
    Route::get('kuliah/edit/{kuliah}', EditKuliah::class)->middleware('role_or_permission:SuperAdmin|editKuliah')->name('kuliah.edit');

    Route::get('kerja-kuliah', IndexKerjaKuliah::class)->middleware('role_or_permission:SuperAdmin|viewKerjaKuliah')->name('kerja-kuliah.index');
    Route::get('kerja-kuliah/add', AddKerjaKuliah::class)->middleware('role_or_permission:SuperAdmin|addKerjaKuliah')->name('kerja-kuliah.add');
    Route::get('kerja-kuliah/edit/{kerjaKuliah}', EditKerjaKuliah::class)->middleware('role_or_permission:SuperAdmin|editKerjaKuliah')->name('kerja-kuliah.edit');

    Route::get('usaha', IndexUsaha::class)->middleware('role_or_permission:SuperAdmin|viewUsaha')->name('usaha.index');
    Route::get('usaha/add', AddUsaha::class)->middleware('role_or_permission:SuperAdmin|addUsaha')->name('usaha.add');
    Route::get('usaha/edit/{usaha}', EditUsaha::class)->middleware('role_or_permission:SuperAdmin|editUsaha')->name('usaha.edit');

    Route::get('mencari-kerja', IndexMencariKerja::class)->middleware('role_or_permission:SuperAdmin|viewMencariKerja')->name('mencari-kerja.index');
    Route::get('mencari-kerja/add', AddMencariKerja::class)->middleware('role_or_permission:SuperAdmin|addMencariKerja')->name('mencari-kerja.add');
    Route::get('mencari-kerja/edit/{mencariKerja}', EditMencariKerja::class)->middleware('role_or_permission:SuperAdmin|editMencariKerja')->name('mencari-kerja.edit');
});
