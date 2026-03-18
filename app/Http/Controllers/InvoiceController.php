<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generate(Repair $repair)
    {
        // View the pdf template
        $pdf = Pdf::loadView('invoices.pdf', compact('repair'));
        
        // Download the file
        return $pdf->download('factura-reparacion-' . $repair->id . '.pdf');
    }
}
