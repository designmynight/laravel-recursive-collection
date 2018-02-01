<?php
namespace DesignMyNight\Laravel\Tests;

use DesignMyNight\Laravel\RecursiveCollectionServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [RecursiveCollectionServiceProvider::class];
    }
}
