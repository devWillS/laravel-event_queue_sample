<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Knp\Snappy\Pdf;

class PdfGenerator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path = '';

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function handle(Pdf $pdf)
    {
        $pdf->generateFromHtml(
            '<h1>Laravel</h1><p>Sample PDF Output.</p>', $this->path
        );
    }
}
