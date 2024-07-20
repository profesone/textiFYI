<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KeywordController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TextifyiNumberController;
use App\Http\Controllers\Admin\TextResponseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Auth\UserTeamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Team
    Route::resource('teams', TeamController::class, ['except' => ['store', 'update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']]);

    // Textifyi Numbers
    Route::post('textifyi-numbers/csv', [TextifyiNumberController::class, 'csvStore'])->name('textifyi-numbers.csv.store');
    Route::put('textifyi-numbers/csv', [TextifyiNumberController::class, 'csvUpdate'])->name('textifyi-numbers.csv.update');
    Route::resource('textifyi-numbers', TextifyiNumberController::class, ['except' => ['store', 'update', 'destroy']]);

    // Client
    Route::post('clients/csv', [ClientController::class, 'csvStore'])->name('clients.csv.store');
    Route::put('clients/csv', [ClientController::class, 'csvUpdate'])->name('clients.csv.update');
    Route::resource('clients', ClientController::class, ['except' => ['store', 'update', 'destroy']]);

    // Keywords
    Route::resource('keywords', KeywordController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit', 'show']]);

    // Text Response
    Route::post('text-responses/csv', [TextResponseController::class, 'csvStore'])->name('text-responses.csv.store');
    Route::put('text-responses/csv', [TextResponseController::class, 'csvUpdate'])->name('text-responses.csv.update');
    Route::resource('text-responses', TextResponseController::class, ['except' => ['store', 'update', 'destroy']]);

    // Messages
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('messages/outbox', [MessageController::class, 'outbox'])->name('messages.outbox');
    Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::get('messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{conversation}', [MessageController::class, 'update'])->name('messages.update');
    Route::post('messages/{conversation}/destroy', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});

Route::group(['prefix' => 'team', 'as' => 'team.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserTeamController.php'))) {
        Route::get('/', [UserTeamController::class, 'show'])->name('show');
        Route::get('{team}/accept', [UserTeamController::class, 'accept'])->middleware('signed')->name('accept');
    }
});
