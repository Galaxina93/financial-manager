<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', function () {
    return view('backend.admin.pages.dashboard');
    })->name('admin.dashboard');

    // Benutzerverwaltung
    Route::get('/admin/user-management', function () {
        return view('backend.admin.pages.user-management');
    })->name('admin.user-management');

    // Benutzerverwaltung
    Route::get('/admin/right-management', function () {
        return view('backend.admin.pages.right-management');
    })->name('admin.right-management');

    // Dateiverwaltung
    Route::get('/admin/file-management', function () {
    return view('backend.admin.pages.file-management');
    })->name('admin.file-management');

    // Profile
    Route::get('/admin/profile', function () {
    return view('backend.admin.pages.profile');
    })->name('admin.profile');

});

Route::middleware('guest:' . implode(',', array_keys(config('auth.guards'))))->group(function () {
    Route::get('/admin/password-reset/{token}', function ($token) {
        return view('global/pages/password/password-reset', ['token' => $token]);
    });
});

