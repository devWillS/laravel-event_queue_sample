<?php

namespace App\Http\Controllers;

use App\Jobs\PdfGenerator;

class PdfGeneratorAction extends Controller
{
    public function __invoke()
    {
        // PdfGenerator::dispatch(storage_path('pdf/sample.pdf'));
        $generator = new PdfGenerator(storage_path('pdf/sample.pdf'));
        dispatch($generator)->onQueue('pdf.generator');
    }
}
