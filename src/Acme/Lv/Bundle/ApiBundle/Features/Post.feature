@Post
Feature: Post Crud.
    In order to manage Post
    As an admin user
    I need to be able to create, update, delete and retrieve posts.

    Scenario:
        Given I have 10 elements
        When I create an element
        Then I should have 11 elements.

    Scenario:
        Given I have 10 elements
        When I delete an element
        Then I should have 9 elements

    Scenario:
        Given I have 10 elements
        When I retrieve all elements
        Then I should see 10 elements
