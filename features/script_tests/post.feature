Feature: Post Feature
    Background:
        Given a user called "Alan" exists
        And a post titled "Title" exists

    Scenario: View posts as a guest
        And I come to the path "/posts"
        Then I see the text "Title"

    Scenario: View posts as an user
        Given I am logged in as "Alan"
        And I come to the path "/posts"
        Then I see the text "Title"

    Scenario: Create new post
        Given I am logged in as "Alan"
        And I create a post with title as "New" and body as "Body" as "Alan"
        And I come to the path "/posts"
        Then I see the text "New"
