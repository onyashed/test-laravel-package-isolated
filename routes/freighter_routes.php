<?php

// test-laravel-package-isolated/src/routes/Test.php

Route::get('verygood/freighter/test', function () {
    return view('test::default');
});
///
Route::get('verygood/freighter/testpack/installmpesapackage', function () {
    Artisan::call('testpackage:remove', [
    ]);

    return 'Freight package Installed successfully.';
});
//Route::auth()->name('login');
/*Route::get('make-migration', function () {
    Artisan::call('make:migration', [
        'name' => 'create_invoices_table',
        '--create' => 'invoices',
    ]);

    return 'Create invoices migration table.';
});*/