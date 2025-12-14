<?php

use App\Contracts\PdfGeneratorInterface;

uses()->group('cv');

it('downloads the cv as a pdf', function () {
    $response = $this->get('/download');

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/pdf');
    $response->assertHeader('content-disposition');
});

it('uses the pdf generator interface', function () {
    $mock = Mockery::mock(PdfGeneratorInterface::class);

    $mock->shouldReceive('generate')
        ->once()
        ->andReturn(new class {
            public function download(string $filename = 'test.pdf') {
                return response(
                    'pdf-content',
                    200,
                    ['content-type' => 'application/pdf']
                );
            }
        });

    app()->instance(PdfGeneratorInterface::class, $mock);

    $response = $this->get('/download');

    $response->assertStatus(200);
});
