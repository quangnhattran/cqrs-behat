<?php

use App\Console\Kernel;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;
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

    /** @BeforeScenario */
    public function before(BeforeScenarioScope $scope)
    {
        $this->artisan('migrate');

        $this->app[Kernel::class]->setArtisan(null);
    }

    /** @AfterScenario */
    public function after(AfterScenarioScope $scope)
    {
        $this->artisan('migrate:rollback');
    }

    /**
     * @Given I come to the path :path
     */
    public function iComeToThePath($path)
    {
        $response = $this->get($path);
        $this->assertEquals(200, $response->getStatusCode());
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
}
