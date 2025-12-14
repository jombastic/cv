<?php

use Illuminate\Support\Facades\Cache;

uses()->group('cv');

it('uses cache to load cv json', function () {
    Cache::spy();

    $this->get('/');
    $this->get('/');

    Cache::shouldHaveReceived('remember')
        ->atLeast()
        ->once();
});
