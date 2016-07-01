@Test2
Feature: Test2 Crud.
    In order to manage test2
    As a user
    I need to be able to create, update, delete and retrieve test2.

    Scenario: Create
        Given I have some test2s
        When I create a new test2
        Then I retrieve new test2 id

#    Scenario: ReadAll
#         Given I have some test2s
#        When I get the test2s list
#        Then I should see a list of test2
#
#    Scenario: Read
#        Given I have created a new test2
#        When I show this test2 by id
#        Then I should see this test2
#
#    Scenario: delete
#        Given I have created a new test2
#        When I delete this test2
#        Then I should not see this test2 in the list
#
#    Scenario: Update
#        Given I have created a new test2
#        When I update this test2 with a new id
#        Then I should see the same test2 with this new id value
