@Entity
Feature: Entity Crud.
    In order to manage entity
    As a user
    I need to be able to create, update, delete and retrieve entity.

    Scenario: Create
        Given I have some entitys
        When I create a new entity
        Then I retrieve new entity id

    Scenario: ReadAll
        Given I have some entitys
        When I get the entitys list
        Then I should see a list of entitys

    Scenario: Read
        Given I have created a new entity
        When I get this entity by id
        Then I should see this entity

    Scenario: delete
        Given I have created a new entity
        When I delete this entity
        Then I should not see this entity

    Scenario: Update
        Given I have created a new entity
        When I update this entity with a new id
        Then I should see the same entity with this new id value
