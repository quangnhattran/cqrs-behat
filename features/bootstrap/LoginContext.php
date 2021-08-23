<?php

use Behat\Behat\Context\Context;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Defines application features from the specific context.
 */
class LoginContext extends TestCase implements Context
{
    use DatabaseMigrations;

    protected $content;

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

    /** @BeforeSuite */
    public static function before(\Behat\Testwork\Hook\Scope\BeforeSuiteScope $scope)
    {
        Artisan::call('migrate:fresh');
    }

    /**
     * @Given I come to the path :path
     */
    public function iComeToThePath($path)
    {
        $response = $this->get($path);
        $this->content = $response->getContent();
    }

    /**
     * @Then I see the text :text
     */
    public function iSeeTheText($text)
    {
        $this->assertStringContainsString($text, $this->content);
    }

    /**
     * @Given a user called :user exists
     */
    public function aUserCalledExists($user)
    {
        $data = [
            'name' => $user,
            "email" => "{$user}_dummy_test@mailinator.com",
            "password" => Hash::make("123456"),
        ];

        $user = factory(User::class)->create($data);
    }

    /**
     * @Given I am logged in as :user
     */
    public function iAmLoggedInAs($user)
    {
        $user = User::where('name', $user)->first();
        $this->be($user);
    }

    /**
     * @Given /^"([^"]*)" make a post with title "([^"]*)"$/
     */
    public function makeAPostWithTitle($arg1, $arg2)
    {
        User::where('name', $arg1)->first()->posts()
            ->create(factory(\App\Models\Post::class)->make(['title' => $arg2])->toArray());
    }
}
