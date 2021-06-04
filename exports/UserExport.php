<?php

namespace AzahariZaman\Excel\Exports;

use Backend\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * Sample Export to Excel Usage. Run route endpoint to download the excel
 */
class UserExport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}