<?php

namespace App\Contracts;

interface MarkdownRendererInterface
{
    public function toHtml(string $markdown): string;
}
