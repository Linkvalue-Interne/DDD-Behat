# @MajoraGenerator({"force_generation": true})
@MajoraEntity
Feature: MajoraEntity Crud.
    In order to manage majora_entity
    As a user
    I need to be able to create, update, delete and retrieve majora_entity.

    Scenario: Create
        Given I have some majora_entitys
        When I create a new majora_entity
        Then I retrieve new majora_entity id

    Scenario: ReadAll
        Given I have some majora_entitys
        When I get the majora_entitys list
        Then I should see a list of majora_entity

    Scenario: Read
        Given I have created a new majora_entity
        When I show this majora_entity by id
        Then I should see this majora_entity

    Scenario: delete
        Given I have created a new majora_entity
        When I delete this majora_entity
        Then I should see the same majora_entity list that before

    Scenario: Update
        Given I have created a new majora_entity
        When I update this majora_entity with a new id
        Then i should see the same majora_entity with this new id value
