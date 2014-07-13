# features/search.feature
Feature: Tasks Page
  In order to view my tasks
  As a new system user
  I can access the task list

  Scenario: View the index page
    When I go to "/"
    Then I should see "Lista de Tarefas"
    And I should see "Apresentar a Aplicação"
    And I should see "Criar a Aplicação"