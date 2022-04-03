<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Admin\EditContact;
use App\Http\Livewire\Admin\IndexContact;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\ProfileManager;
use App\Http\Livewire\Register;
use App\Http\Livewire\Request\RequestIndex;
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
use App\Http\Livewire\User\Kerja\Index as KerjaIndex;
use App\Http\Livewire\User\KerjaKuliah\Index as KerjaKuliahIndex;
use App\Http\Livewire\User\Kuliah\Index as KuliahIndex;
use App\Http\Livewire\User\MencariKerja\Index as MencariKerjaIndex;
use App\Http\Livewire\User\Usaha\Index as UsahaIndex;
use App\Http\Livewire\Users\AddUser;
use App\Http\Livewire\Users\EditUser;
use App\Http\Livewire\Users\IndexUsers;
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

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::get('/send_cs', function () {
    return "again an example";
})->name('send_cs');

Route::get('/', Home::class)->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [DashboardController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['role:SuperAdmin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::get('users', IndexUsers::class)->name('users');
        Route::get('users/add', AddUser::class)->name('users.add');
        Route::get('users/edit/{user}', EditUser::class)->name('users.edit');
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('contact', IndexContact::class)->name('contact');
        Route::get('contact/edit/{publicContact}', EditContact::class)->name('contact.edit');
        Route::get('request', RequestIndex::class)->name('request');
    });

    Route::group(['middleware' => ['role_or_permission:SuperAdmin|edit profile']], function () {
        Route::get('/profile', ProfileManager::class)->name('profile');
    });

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

    Route::group(['middleware' => ['role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('kerja', KerjaIndex::class)->name('kerja');
        Route::get('kuliah', KuliahIndex::class)->name('kuliah');
        Route::get('kerja_kuliah', KerjaKuliahIndex::class)->name('kerjakuliah');
        Route::get('mencari_kerja', MencariKerjaIndex::class)->name('mencarikerja');
        Route::get('usaha', UsahaIndex::class)->name('usaha');

        Route::middleware('permission:participate')->group(function () {
            Route::get('add/kerja', AddKerja::class)->name('add.kerja');
            Route::get('add/kerjakuliah', AddKerjaKuliah::class)->name('add.kerjakuliah');
            Route::get('add/kuliah', AddKuliah::class)->name('add.kuliah');
            Route::get('add/mencari_kerja', AddMencariKerja::class)->name('add.mencarikerja');
            Route::get('add/usaha', AddUsaha::class)->name('add.usaha');
        });
    });

    Route::group(['middleware' => ['role:disabled']], function () {
        Route::view('/disabled/dashboard', 'disabled')->name('disabled.dashboard');
    });
});
