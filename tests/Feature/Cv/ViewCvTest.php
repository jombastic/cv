<?php

use Illuminate\Support\Facades\Cache;
use App\Contracts\MarkdownRendererInterface;

uses()->group('cv');

it('loads the cv page successfully', function () {
    Cache::flush();

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertViewIs('cv.show');
});

it('passes cv data to the view', function () {
    $response = $this->get('/');

    $response->assertViewHas('cv');
});

it('renders experience sections', function () {
    $response = $this->get('/');

    $response->assertSee('Experience');
});

it('renders social links', function () {
    $response = $this->get('/');

    $response->assertSee('linkedin', false);
});

it('allows swapping markdown renderer implementation', function () {
    $mock = Mockery::mock(MarkdownRendererInterface::class);
    $mock->shouldReceive('toHtml')
        ->andReturn('<p>mocked markdown</p>');

    app()->instance(MarkdownRendererInterface::class, $mock);

    $response = $this->get('/');

    $response->assertSee('mocked markdown', false);
});
