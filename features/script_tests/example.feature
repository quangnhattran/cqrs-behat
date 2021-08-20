Feature: Mink Extension utilized Goutte

    Scenario: Dummy Example
        Given I am on the homepage
        When I follow "Forgot Your Password"
        Then the url should match "/abc"

    Scenario: Failed Login
        Given I am on "/login"
        Then I should see "Login"
        And I fill in "wweimann@example.com" for "email"
        And I fill in "123456" for "password"
        Then I press "Login"
        Then I am on "/home"
        And I should see "You are logged in"
