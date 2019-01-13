<?php

// test-laravel-package-isolated/src/routes/Test.php

Route::get('test', function () {
    return view('test::default');
});
