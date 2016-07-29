@Person2
Feature: Person2 Crud.
    In order to manage person2
    As a user
    I need to be able to create, update, delete and retrieve person2.

    Scenario: Create
        Given I have some person2s
        When I create a new person2
        Then I retrieve new person2 id

    Scenario: ReadAll
        Given I have some person2s
        When I get the person2s list
        Then I should see a list of person2

    Scenario: Read
        Given I have created a new person2
        When I get this person2 by id
        Then I should see this person2

    Scenario: delete
        Given I have created a new person2
        When I delete this person2
        Then I should not see this person2

    Scenario: Update
        Given I have created a new person2
        When I update this person2 with a new id
        Then I should see the same person2 with this new id value
