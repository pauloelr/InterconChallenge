# features/create.feature
Feature: Delete Tasks Page
  In order to add new tasks
  As a new system user
  I need access the delete task page

  Scenario: View the delete page
    When I am on "/delete/1"
    Then I should see "Exclusão de Tarefa"

  Scenario: Delete task
    When I am on "/delete/1"
    And I press "confirm"
    Then I should not see "Criar a Aplicação"