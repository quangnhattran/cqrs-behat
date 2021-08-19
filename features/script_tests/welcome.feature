Feature: Welcome Page
    Scenario: Come to root path
        When I visit the path "/"
        Then I should see the text "Laravel"
