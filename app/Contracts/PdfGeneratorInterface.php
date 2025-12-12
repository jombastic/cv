<?php

namespace App\Contracts;

interface PdfGeneratorInterface
{
    public function generate(string $view, array $data = []): mixed;
}
