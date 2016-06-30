# @MajoraGenerator({"force_generation": true})
@MajoraEntity
Feature: MajoraEntity Crud.
    In order to manage majora_entity
    As a user
    I need to be able to create, update, delete and retrieve majora_entity.

    Background: Fixtures
        Given I have theses majora_entity:
            | key             | id |
            | majora_entity_1 | 1  |
            | majora_entity_2 | 2  |
            | majora_entity_3 | 3  |

    Scenario: Read
        Given I get the majora_entity list
        Then I should see theses majora_entity:
            | id |
            | 1  |
            | 2  |
            | 3  |

    Scenario: Create
        Given I create theses majora_entity:
            | id |
            | 4  |
        And I get the majora_entity list
        Then I should see theses majora_entity:
            | id |
            | 1  |
            | 2  |
            | 3  |
            | 4  |

    Scenario: Update
        Given I update the "majora_entity_2" majora_entity with theses values:
            | id |
            | 4  |
        And I get the majora_entity list
        Then I should see theses majora_entity:
            | id |
            | 1  |
            | 4  |
            | 3  |
        And I should not see theses majora_entity:
            | id |
            | 2  |

    Scenario: Delete
        Given I delete the "majora_entity_2" majora_entity
        And I get the majora_entity list
        Then I should see theses majora_entity:
            | id |
            | 1  |
            | 3  |
        And I should not see theses majora_entity:
            | id |
            | 2  |