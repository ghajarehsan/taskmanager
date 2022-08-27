<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use \App\Models\User;
use \App\Models\Role;


//here is just for setting of upload file
Route::group(['prefix' => 'file'], function () {

    Route::get('index', [FileController::class, 'index'])->name('file.index');

    Route::post('upload', [FileController::class, 'upload'])->name('file.upload');

});

//here is just for setting of permissions and roles
Route::group(['prefix' => 'adjustPermission'], function () {

    Route::group(['prefix' => 'permission'], function () {

        Route::get('addPermission', function () {
            dd(User::find(1)->givePermissionTo(['addPost', 'addUser']));
        });

        Route::get('refreshPermissionTo', function () {
            dd(User::find(1)->refreshPermissionTo(['addPost', 'addUser']));
        });

        Route::get('detachPermissionTo', function () {
            dd(User::find(1)->detachPermissionTo(['addPost', 'addUser']));
        });

        Route::get('getAllPermission', function () {
            dd(User::find(1)->permissions);
        });
        Route::get('hasPermission', function () {
            dd(User::find(1)->hasPermission('addUser'));
        });


    });

    Route::group(['prefix' => 'role'], function () {

        Route::get('addRole', function () {
            dd(User::find(1)->giveRoleTo(['admin']));
        });

        Route::get('refreshRole', function () {
            dd(User::find(1)->refreshRoleTo(['teacher']));
        });

        Route::get('hasRole', function () {
            dd(User::find(1)->hasRole('teacher'));
        });

        Route::get('detachRoleTo', function () {
            dd(User::find(1)->detachRoleTo(['admin']));
        });

        Route::get('getAllRole', function () {
            dd(User::find(1)->roles);
        });

    });

    Route::group(['prefix' => 'rolePermission'], function () {

        Route::get('addPermission', function () {
            dd(Role::find(1)->givePermissionTo(['addPost']));
        });
        Route::get('refreshPermissionTo', function () {
            dd(Role::find(1)->refreshPermissionTo(['addPost', 'addUser']));
        });
        Route::get('detachPermissionTo', function () {
            dd(Role::find(1)->detachPermissionTo(['addPost', 'addUser']));
        });
        Route::get('getAllPermission', function () {
            dd(Role::find(1)->permissions);
        });

    });

    Route::get('testPermission', function () {
        dd('asd');
    })->middleware('permission:addUser');

});

