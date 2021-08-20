<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class ExampleContext extends MinkContext implements Context
{
    /**
     *  @BeforeScenario
     */
    public function before(BeforeScenarioScope $scope)
    {
        $this->setMinkParameter(
            'base_url', 'http://cf5b8025d992.ngrok.io/'
        );
    }

    /**
     * @Then /^I wait for "([^"]*)" seconds$/
     */
    public function iWaitForSeconds($arg1)
    {
        sleep($arg1);
    }
}
