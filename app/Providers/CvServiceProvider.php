<?php

namespace App\Providers;

use App\Contracts\MarkdownRendererInterface;
use App\Contracts\PdfGeneratorInterface;
use App\Services\Markdown\CommonMarkMarkdownRenderer;
use App\Services\Pdf\DomPdfGenerator;
use Illuminate\Support\ServiceProvider;

class CvServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MarkdownRendererInterface::class, CommonMarkMarkdownRenderer::class);
        $this->app->bind(PdfGeneratorInterface::class, DomPdfGenerator::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
