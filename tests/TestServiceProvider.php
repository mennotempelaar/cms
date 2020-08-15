<?php

declare(strict_types = 1);

namespace DigitalCreative\Dashboard\Tests;

use DigitalCreative\Dashboard\DashboardServiceProvider;
use DigitalCreative\Dashboard\Tests\Fixtures\Resources\User;
use JohnDoe\BlogPackage\BlogPackageServiceProvider;

class TestServiceProvider extends DashboardServiceProvider
{
    public function resources(): array
    {
        return [
            User::class
        ];
    }
}
