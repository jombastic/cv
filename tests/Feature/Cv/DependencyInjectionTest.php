<?php

use App\Contracts\MarkdownRendererInterface;
use App\Contracts\PdfGeneratorInterface;

uses()->group('cv');

it('resolves markdown renderer from the container', function () {
    $renderer = app(MarkdownRendererInterface::class);

    expect($renderer)->not()->toBeNull();
});

it('resolves pdf generator from the container', function () {
    $generator = app(PdfGeneratorInterface::class);

    expect($generator)->not()->toBeNull();
});
