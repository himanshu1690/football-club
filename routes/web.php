<?php

use Illuminate\Support\Facades\Auth;
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
     //dd(\App\Models\Club::with(['clubAdmins.user', 'teams.playerGroups.players'])->get());
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin'], function(){
    Route::get('/clubs/{club}/admins', [\App\Http\Controllers\ClubController::class, 'admins'])->name('clubs.admin');
    Route::delete('/clubs/{club}/admins/{admin}', [\App\Http\Controllers\ClubController::class, 'deleteAdmin'])->name('clubs.remove.admin');
    Route::get('/clubs/{club}/add/admin', [\App\Http\Controllers\ClubController::class, 'addAdmin'])->name('clubs.add.admin');
    Route::post('/clubs/{club}/add/admin', [\App\Http\Controllers\ClubController::class, 'saveAdmin']);

    Route::get('/player-groups/{team}', [\App\Http\Controllers\PlayerGroupController::class, 'index'])->name('player.group.index');
    Route::get('/player-groups/{team}/create', [\App\Http\Controllers\PlayerGroupController::class, 'create'])->name('player.group.create');
    Route::post('/player-groups/{team}/create', [\App\Http\Controllers\PlayerGroupController::class, 'store']);
    Route::get('/player-groups/{playerGroup}/edit', [\App\Http\Controllers\PlayerGroupController::class, 'edit'])->name('player.group.edit');
    Route::put('/player-groups/{playerGroup}', [\App\Http\Controllers\PlayerGroupController::class, 'update'])->name('player.group.update');
    Route::delete('/player-groups/{playerGroup}', [\App\Http\Controllers\PlayerGroupController::class, 'destroy'])->name('player.group.delete');

    Route::get('/players/{group}', [\App\Http\Controllers\PlayerController::class, 'index'])->name('players.index');
    Route::get('/players/{group}/create', [\App\Http\Controllers\PlayerController::class, 'create'])->name('players.create');
    Route::post('/players/{group}/create', [\App\Http\Controllers\PlayerController::class, 'store']);
    Route::get('/players/edit/{player}', [\App\Http\Controllers\PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [\App\Http\Controllers\PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{player}', [\App\Http\Controllers\PlayerController::class, 'destroy'])->name('players.delete');

    Route::get('/users/impersonate/{user}', [\App\Http\Controllers\UserController::class, 'impersonateUser'])->name('users.impersonate');
    Route::get('/users/leave/impersonate', [\App\Http\Controllers\UserController::class, 'leaveImpersonate'])->name('users.leave.impersonate');
    Route::get('/clubs/{club}/teams', [\App\Http\Controllers\TeamController::class, 'clubTeams'])->name('clubs.team');

    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('clubs', \App\Http\Controllers\ClubController::class);
    Route::resource('teams', \App\Http\Controllers\TeamController::class);
});
