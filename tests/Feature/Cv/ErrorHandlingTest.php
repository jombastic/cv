<?php

use Illuminate\Support\Facades\File;

uses()->group('cv');

it('fails gracefully when markdown files are missing', function () {
    File::shouldReceive('get')
        ->andThrow(new Exception('File not found'));

    $response = $this->get('/');

    $response->assertStatus(500);
});
