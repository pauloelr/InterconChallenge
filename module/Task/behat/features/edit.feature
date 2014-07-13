# features/edit.feature
Feature: Edit Tasks Page
  In order to edit tasks
  As a new system user
  I need access the edit task page

  Scenario: View the edit page
    When I am on "/edit/1"
    Then I should see "Edição de Tarefa"
    And the "Task[title]" field should contain "Criar a Aplicação"
    And the "Task[description]" field should contain "Criar a Aplicação para o interconPHP"

  Scenario: Submit edit task
    When I am on "/edit/1"
    And I fill in "Task[title]" with "Behat Test Title"
    And I fill in "Task[description]" with "Behat Test Description"
    And I press "submit"
    Then I should see "Lista de Tarefas"
    And I should see "Behat Test Title"
    And I should not see "Criar a Aplicação"