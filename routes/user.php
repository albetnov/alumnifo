<?php

use App\Http\Livewire\Tables\Kerja\AddKerja;
use App\Http\Livewire\Tables\KerjaKuliah\AddKerjaKuliah;
use App\Http\Livewire\Tables\Kuliah\AddKuliah;
use App\Http\Livewire\Tables\MencariKerja\AddMencariKerja;
use App\Http\Livewire\Tables\Usaha\AddUsaha;
use App\Http\Livewire\User\Delete;
use App\Http\Livewire\User\Kerja\EditKerjaUser;
use App\Http\Livewire\User\Kerja\Index as KerjaIndex;
use App\Http\Livewire\User\KerjaKuliah\EditKerjaKuliahUser;
use App\Http\Livewire\User\KerjaKuliah\Index as KerjaKuliahIndex;
use App\Http\Livewire\User\Kuliah\EditKuliahUser;
use App\Http\Livewire\User\Kuliah\Index as KuliahIndex;
use App\Http\Livewire\User\MencariKerja\EditMencariKerjaUser;
use App\Http\Livewire\User\MencariKerja\Index as MencariKerjaIndex;
use App\Http\Livewire\User\Request;
use App\Http\Livewire\User\Usaha\EditUsahaUser;
use App\Http\Livewire\User\Usaha\Index as UsahaIndex;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('kerja', KerjaIndex::class)->name('kerja');
    Route::get('kuliah', KuliahIndex::class)->name('kuliah');
    Route::get('kerja_kuliah', KerjaKuliahIndex::class)->name('kerjakuliah');
    Route::get('mencari_kerja', MencariKerjaIndex::class)->name('mencarikerja');
    Route::get('usaha', UsahaIndex::class)->name('usaha');
    Route::get('delete', Delete::class)->name('delete');
    Route::get('request', Request::class)->name('request');

    Route::middleware('permission:participate')->group(function () {
        Route::get('add/kerja', AddKerja::class)->name('add.kerja');
        Route::get('add/kerjakuliah', AddKerjaKuliah::class)->name('add.kerjakuliah');
        Route::get('add/kuliah', AddKuliah::class)->name('add.kuliah');
        Route::get('add/mencari_kerja', AddMencariKerja::class)->name('add.mencarikerja');
        Route::get('add/usaha', AddUsaha::class)->name('add.usaha');
        Route::get('edit/kerja/{kerja}', EditKerjaUser::class)->name('edit.kerja');
        Route::get('edit/kuliah/{kuliah}', EditKuliahUser::class)->name('edit.kuliah');
        Route::get('edit/kerja-kuliah/{kerjaKuliah}', EditKerjaKuliahUser::class)->name('edit.kerjakuliah');
        Route::get('edit/mencari-kerja/{mencariKerja}', EditMencariKerjaUser::class)->name('edit.mencarikerja');
        Route::get('edit/usaha/{usaha}', EditUsahaUser::class)->name('edit.usaha');
    });
});
