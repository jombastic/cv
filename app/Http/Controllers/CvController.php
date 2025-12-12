<?php

namespace App\Http\Controllers;

use App\Contracts\PdfGeneratorInterface;
use App\Services\CvService;

class CvController extends Controller
{
    public function __construct(
        private CvService $cvService,
        private PdfGeneratorInterface $pdf
    ) {}

    public function show()
    {
        $cv = $this->cvService->getCvData();

        return view('cv.show', compact('cv'));
    }

    public function downloadPdf()
    {
        $cv = $this->cvService->getCvData();

        $pdf = $this->pdf->generate('cv.pdf', compact('cv'));
        return $pdf->download('cv.pdf');
    }
}
