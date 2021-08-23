<?php

namespace BDDTests\traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait CommonSteps
{
    protected string $content;

    /**
     * @When I visit the path :path
     */
    public function iVisitThePath($path)
    {
        $response = $this->get($path);
        $this->assertEquals(200, $response->getStatusCode());
        $this->content = $response->getContent();
    }

    /**
     * @Then I should see the text :text
     */
    public function iShouldSeeTheText($text)
    {
        $this->assertStringContainsString($text, $this->content);
    }
}
