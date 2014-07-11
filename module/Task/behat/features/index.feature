# features/search.feature
Feature: Tasks Page
  In order to view my tasks
  As a new system user
  I can access the task list

  Scenario: View the index page
    When I go to "/"
    Then I should see "Tasks"