<?php

namespace App\Services\Pdf;

use App\Contracts\PdfGeneratorInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class DomPdfGenerator implements PdfGeneratorInterface
{
    public function generate(string $view, array $data = []): mixed
    {
        return Pdf::loadView($view, $data)
            ->setPaper('a4', 'portrait');
    }
}
