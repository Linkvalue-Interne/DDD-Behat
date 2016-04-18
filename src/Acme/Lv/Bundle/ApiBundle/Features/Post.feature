@Post
Feature: Post Crud.
    In order to manage Post
    As an admin user
    I need to be able to create, update, delete and retrieve posts.

    Background: Fixtures
    Given I have theses posts:
    | key    | name   |
    | post_1 | Gérard |
    | post_2 | Michel |
    | post_3 | André  |

    Scenario: Read
    Given I get the post list
    Then I should see theses posts:
    | name   |
    | Gérard |
    | Michel |
    | André  |

    Scenario: Create
    Given I create theses posts:
    | name  |
    | Clark |
    And I get the post list
    Then I should see theses posts:
    | name   |
    | Gérard |
    | Michel |
    | André  |
    | Clark  |

    Scenario: Update
    Given I update the "post_2" post with theses values:
    | name  |
    | Bruce |
    And I get the post list
    Then I should see theses posts:
    | name   |
    | Gérard |
    | Bruce  |
    | André  |
    And I should not see theses posts:
    | name    |
    | Michel  |

    Scenario: Delete
    Given I delete the "post_2" post
    And I get the post list
    Then I should see theses posts:
    | name   |
    | Gérard |
    | André  |
    And I should not see theses posts:
    | name    |
    | Michel  |
