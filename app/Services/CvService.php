<?php

namespace App\Services;

use App\Contracts\MarkdownRendererInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CvService
{
    private string $jsonPath;
    private string $markdownPath;
    private MarkdownRendererInterface $markdown;

    public function __construct(MarkdownRendererInterface $markdown)
    {
        $this->jsonPath = 'cv.json';
        $this->markdownPath = 'markdown/';
        $this->markdown = $markdown;
    }

    public function getCvData(): array
    {
        $cv = $this->loadJson();

        $cv['summary_html'] = $this->loadMarkdownToHtml($cv['summary_md_file']);

        $cv['experience'] = $this->processExperience($cv['experience']);

        return $cv;
    }

    protected function loadJson(): array
    {
        return Cache::remember('cv-json', 3600, function () {
            return Storage::disk('data')->json($this->jsonPath);
        });
    }

    protected function loadMarkdownToHtml(string $filename): string
    {
        $markdownContent = Cache::remember($filename, 3600, function () use ($filename) {
            return Storage::disk('data')->get($this->markdownPath . $filename);
        });

        return $this->markdown->toHtml($markdownContent);
    }

    protected function processExperience(array $experience): array
    {
        return array_map(function ($item) {
            $item['description_html'] = $this->loadMarkdownToHtml($item['markdown_file']);
            return $item;
        }, $experience);
    }
}
