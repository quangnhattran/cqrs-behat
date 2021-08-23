Feature: Login
    Background:
        Given a user called "Alan" exists
        And a user called "Bob" exists
        And a user called "Clare" exists
        And a user called "Derek" exists
        And a user called "Eric" exists

    Scenario: Log in as Alan
        Given I am logged in as "Alan"
        And I come to the path "/home"
        Then I see the text "You are logged in"

    Scenario: Logged in user
        Given I am logged in as "Alan"
        Then I come to the path "/login"
        And the url should match "/example"
        Then I come to the path "/home"
        And I see the text "Alan"

    Scenario: Post
        Given "Alan" make a post with title "ABC"
        Then I come to the path "/posts"
        And I see the text "ABC"

