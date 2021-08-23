Feature: Laravel Behat Extension
    In order to make testing setup easier
    As a teacher
    I want to show an example of installing and using the Laravel Behat extension.

    Background:
        Given a user called "Alan" exists

    Scenario: Dummy Example
        Given I am on the homepage
        When I follow "Click Me"
        Then the url should match "/example"
        And I should see "It works!"

