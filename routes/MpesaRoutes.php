<?php

// test-laravel-package-isolated/src/routes/Test.php

Route::get('goodsystem/testpack/mpesa/test', function () {
    return view('test::default');
});
///
Route::get('goodsystem/testpack/installmpesapackage', function () {
    Artisan::call('testpackage:remove', [
    ]);

    return 'Mpesa package Installed successfully.';
});
//Route::auth()->name('login');
/*Route::get('make-migration', function () {
    Artisan::call('make:migration', [
        'name' => 'create_invoices_table',
        '--create' => 'invoices',
    ]);

    return 'Create invoices migration table.';
});*/