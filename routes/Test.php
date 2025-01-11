<?php

// test-laravel-package-isolated/src/routes/Test.php
use Illuminate\Support\Facades\Route;
Route::get('goodsystem/testpack/test', function () {
    return view('test::default');
});
///
Route::get('goodsystem/testpack/ed')->name('ed');
Route::get('goodsystem/testpack/installpackage', function () {
    Artisan::call('foopackage:install', [
    ]);

    return 'package Installed successfully.';
});
/*Route::get('make-migration', function () {
    Artisan::call('make:migration', [
        'name' => 'create_invoices_table',
        '--create' => 'invoices',
    ]);

    return 'Create invoices migration table.';
});*/