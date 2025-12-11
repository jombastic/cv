<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;

class CvController extends Controller
{
    public function show()
    {
        $cv = json_decode(Storage::disk('data')->get('cv.json'), true);

        $converter = new CommonMarkConverter();

        $summaryMarkdown = Storage::disk('data')->get('markdown/' . $cv['summary_md_file']);
        $cv['summary_html'] = $converter->convert($summaryMarkdown)->getContent();

        foreach ($cv['experience'] as $i => $exp) {
            $file = Storage::disk('data')->get('markdown/' . $exp['markdown_file']);
            $cv['experience'][$i]['description_html'] = $converter->convert($file)->getContent();
        }

        return view('cv.show', compact('cv'));
    }

    public function downloadPdf() {}
}
