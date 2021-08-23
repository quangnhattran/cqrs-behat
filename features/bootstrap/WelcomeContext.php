<?php

use BDDTests\traits\CommonSteps;
use Behat\Behat\Context\Context;
use Tests\TestCase;

/**
 * Defines application features from the specific context.
 */
class WelcomeContext extends TestCase implements Context
{
    use CommonSteps;

    public function __construct()
    {
        parent::setUp();
    }
}
