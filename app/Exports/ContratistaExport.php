<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContratistaExport implements FromView
{
    protected $contratistas;

    public function __construct($contratistas)
    {
        $this->contratistas = $contratistas;
    }

    public function view(): View
    {
        return view('modulos.gestion_contratistas.reporte_pdf.excel', [
            'contratistas' => $this->contratistas
        ]);
    }
}
