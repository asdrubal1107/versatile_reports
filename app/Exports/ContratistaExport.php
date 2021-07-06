<?php

namespace App\Exports;

use App\Models\Contratista;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContratistaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contratista::all();
    }
}
