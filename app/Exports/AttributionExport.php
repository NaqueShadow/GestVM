<?php

namespace App\Exports;

use App\Attribution;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttributionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attribution::all();
    }
}
