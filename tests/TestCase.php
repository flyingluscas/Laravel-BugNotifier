<?php

namespace FlyingLuscas\BugNotifier;

use Mockery;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * {@inheritdoc}
     */
    public function getPackageProviders($app)
    {
        return [BugNotifierServiceProvider::class];
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
