<?php

namespace App\Services\Markdown;

use App\Contracts\MarkdownRendererInterface;
use League\CommonMark\CommonMarkConverter;

class CommonMarkMarkdownRenderer implements MarkdownRendererInterface
{
    protected CommonMarkConverter $converter;

    public function __construct() {
        $this->converter = new CommonMarkConverter();
    }

    public function toHtml(string $markdown): string
    {
        return $this->converter->convert($markdown)->getContent();
    }
}
