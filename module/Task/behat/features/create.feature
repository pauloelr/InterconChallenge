# features/create.feature
Feature: Create Tasks Page
  In order to add new tasks
  As a new system user
  I need access the add task page

  Scenario: View the create page
    When I am on "/"
    And I follow "Adicionar Tarefa"
    Then I should see "Cadastro de Tarefas"

  Scenario: Submit new task
    When I am on "/add"
    And I fill in "Task[title]" with "Behat Test Title"
    And I fill in "Task[description]" with "Behat Test Description"
    And I press "submit"
    Then I should see "Lista de Tarefas"
    And I should see "Behat Test Title"