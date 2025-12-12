<?php

namespace App\Http\Controllers;

use App\Services\CvService;

class CvController extends Controller
{
    public function __construct(private CvService $cvService) {}

    public function show()
    {
        $cv = $this->cvService->getCvData();

        return view('cv.show', compact('cv'));
    }

    public function downloadPdf()
    {
        $cv = $this->cvService->getCvData();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('cv.pdf', compact('cv'))->setPaper('a4', 'portrait');
        return $pdf->download('cv.pdf');
    }
}
