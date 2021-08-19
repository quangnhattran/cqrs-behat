<?php

use Behat\Behat\Context\Context;

class PostContext extends \Tests\TestCase implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        parent::setUp();
    }

    /**
     * @Given /^a post titled "([^"]*)" exists$/
     */
    public function aPostTitledExists($arg1)
    {
        $userId = \App\User::first()->id;
        factory(\App\Post::class)->create(['title' => 'Title', 'user_id' => $userId]);
    }

    /**
     * @Given /^I create a post with title as "([^"]*)" and body as "([^"]*)" as "([^"]*)"$/
     */
    public function iCreateAPostWithTitleAsAndBodyAsAs($title, $body, $name)
    {
        \App\User::where('name', $name)->first()->posts()->create(['title' => $title, 'body' => $body]);
    }
}
