<?php

namespace App\Exports;

use App\Models\Subscribe;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscribeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subscribe::all();
    }
}
