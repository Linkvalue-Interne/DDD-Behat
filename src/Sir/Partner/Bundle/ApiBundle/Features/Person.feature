# @MajoraGenerator({"force_generation": true})
@Person
Feature: Person Crud.
    In order to manage person
    As a user
    I need to be able to create, update, delete and retrieve person.

    Background: Fixtures
        Given I have theses persons:
            | key             | id |
            | person_1 | 1  |
            | person_2 | 2  |
            | person_3 | 3  |

    Scenario: Read
        Given I get the person list
        Then I should see theses persons:
            | id |
            | 1  |
            | 2  |
            | 3  |

    Scenario: Create
        Given I create theses persons:
            | id |
            | 4  |
        And I get the person list
        Then I should see theses persons:
            | id |
            | 1  |
            | 2  |
            | 3  |
            | 4  |

    Scenario: Update
        Given I update the "person_2" person with theses values:
            | id |
            | 4  |
        And I get the person list
        Then I should see theses persons:
            | id |
            | 1  |
            | 4  |
            | 3  |
        And I should not see theses persons:
            | id |
            | 2  |

    Scenario: Delete
        Given I delete the "person_2" person
        And I get the person list
        Then I should see theses persons:
            | id |
            | 1  |
            | 3  |
        And I should not see theses persons:
            | id |
            | 2  |
