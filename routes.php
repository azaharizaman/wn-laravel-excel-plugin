<?php

use AzahariZaman\Excel\Exports\UserExport;

Route::get('/export-user', function () {
    return Excel::download(new UserExport, 'user.xlsx');
});
