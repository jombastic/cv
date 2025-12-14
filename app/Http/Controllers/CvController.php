<?php

namespace App\Http\Controllers;

use App\Contracts\PdfGeneratorInterface;
use App\Services\CvService;

class CvController extends Controller
{
    public function __construct(
        private CvService $cvService,
    ) {}

    public function show()
    {
        $cv = $this->cvService->getCvData();

        return view('cv.show', compact('cv'));
    }

    public function downloadPdf(PdfGeneratorInterface $pdf)
    {
        $cv = $this->cvService->getCvData();

        $pdf = $pdf->generate('cv.pdf', compact('cv'));
        return $pdf->download('cv.pdf');
    }
}
