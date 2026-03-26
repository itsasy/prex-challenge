<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Client::firstOrCreate(
            [
                'provider' => 'users',
                'name' => 'Laravel',
            ],
            [
                'secret' => bcrypt('secret'),
                'redirect_uris' => [],
                'revoked' => false,
                'grant_types' => ['personal_access'],
                'owner_type' => null,
                'owner_id' => null,
            ]
        );

        Passport::actingAsClient(Client::firstWhere('provider', 'users'));
    }
}
