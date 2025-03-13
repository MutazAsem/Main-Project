<?php

namespace Travelx\School\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Travelx\School\SchoolServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SchoolServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        
        // تشغيل الترحيلات للحزمة
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // تشغيل الترحيلات الخاصة بالمشروع الأساسي
        $this->artisan('migrate');
    }
}
