<?php
namespace Intercon\Challenge\TaskTest\Controller;

use Intercon\Challenge\Task\Controller\TaskController;
use Intercon\Challenge\Task\Entity\Task;

class TaskControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListReturnListOfTask()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('findBy')->once()->andReturn($this->getRowsetTask());

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $expected = array('collection' => $this->getRowsetTask());
        $this->assertEquals($expected, $taskController->getList());
    }

    public function testCreateReturnFormIfInvalidDataAreSupplied()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');
        $taskForm->shouldReceive('setData')->once()->andReturn(null);
        $taskForm->shouldReceive('isValid')->once()->andReturn(false);

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $expected = array('form' => $taskForm);
        $this->assertEquals($expected, $taskController->create(array()));
    }

    public function testCreateInsertDataIfValid()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('insert')->once()->andReturn(null);

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');
        $taskForm->shouldReceive('setData')->once()->andReturn(null);
        $taskForm->shouldReceive('isValid')->once()->andReturn(true);
        $taskForm->shouldReceive('getData')->once()->andReturn($this->getRowsetTask()[0]);

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->create(array()));
    }

    public function testUpdateRedirectIfTaskDoesNotExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->update(1, array()));
    }

    public function testUpdateReturnFormIfInvalidDataAreSupplied()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturn($this->getRowsetTask()[0]);

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');
        $taskForm->shouldReceive('bind')->once()->andReturn(null);
        $taskForm->shouldReceive('setData')->once()->andReturn(null);
        $taskForm->shouldReceive('isValid')->once()->andReturn(false);

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $expected = array('form' => $taskForm);
        $this->assertEquals($expected, $taskController->update(1, array()));
    }

    public function testUpdateInsertDataIfValid()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturn($this->getRowsetTask()[0]);
        $taskMapper->shouldReceive('update')->once()->andReturn(null);

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');
        $taskForm->shouldReceive('bind')->once()->andReturn(null);
        $taskForm->shouldReceive('setData')->once()->andReturn(null);
        $taskForm->shouldReceive('isValid')->once()->andReturn(true);

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->update(1, array()));
    }

    public function testDeleteRedirectIfTaskDoesNotExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->delete(1));
    }

    public function testDeleteRemoveData()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturn($this->getRowsetTask()[0]);
        $taskMapper->shouldReceive('delete')->once()->andReturn(null);

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->delete(1));
    }

    public function testAddActionReturnForm()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $expected = array('form' => $taskForm);
        $this->assertEquals($expected, $taskController->addAction());
    }

    public function testEditActionRedirectIfTaskDoesNotExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->editAction());
    }

    public function testEditActionReturnFormIfTaskExists()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturn($this->getRowsetTask()[0]);

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');
        $taskForm->shouldReceive('bind')->once()->andReturn(null);

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $expected = array('form' => $taskForm);
        $this->assertEquals($expected, $taskController->editAction());
    }

    public function testDeleteActionRedirectIfTaskDoesNotExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->deleteAction());
    }

    public function testDeleteActionReturnIdIfTaskExists()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturn($this->getRowsetTask()[0]);

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $expected = array('id' => 1);
        $this->assertEquals($expected, $taskController->deleteAction());
    }

    public function testCompleteActionRedirectIfTaskDoesNotExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->completeAction());
    }

    public function testCompleteActionRedirectIfTaskExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturn($this->getRowsetTask()[0]);
        $taskMapper->shouldReceive('update')->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->completeAction());
    }

    public function testTodoActionRedirectIfTaskDoesNotExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->todoAction());
    }

    public function testTodoActionRedirectIfTaskExist()
    {
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');
        $taskMapper->shouldReceive('find')->with(1)->once()->andReturn($this->getRowsetTask()[0]);
        $taskMapper->shouldReceive('update')->once()->andReturnNull();

        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        /** @var $taskForm \Intercon\Challenge\Task\Form\TaskForm */
        $taskController = new TaskController($taskMapper, $taskForm);

        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager');
        $pluginManager->shouldReceive('setController')->andReturn(\Mockery::self());

        $paramPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $paramPlugin->shouldReceive('__invoke')->once()->andReturn(\Mockery::self());
        $paramPlugin->shouldReceive('fromRoute')->once()->andReturn(1);

        $pluginManager->shouldReceive('get')
            ->with('params', \Mockery::any())
            ->andReturn($paramPlugin)
            ->once();

        $flashMessenger = \Mockery::mock('Zend\Mvc\Controller\Plugin\FlashMessenger');
        $flashMessenger->shouldReceive('setNamespace')->once()->andReturn(\Mockery::self());
        $flashMessenger->shouldReceive('addMessage')->once()->andReturn(\Mockery::self());

        $pluginManager->shouldReceive('get')
            ->with('flashMessenger', \Mockery::any())
            ->andReturn($flashMessenger)
            ->once();

        $redirectPlugin = \Mockery::mock('Zend\Mvc\Controller\Plugin\Redirect');
        $redirectPlugin->shouldReceive('toRoute')->once()->andReturn('redirect');

        $pluginManager->shouldReceive('get')
            ->with('redirect', \Mockery::any())
            ->andReturn($redirectPlugin)
            ->once();

        /** @var $pluginManager \Zend\Mvc\Controller\PluginManager */
        $taskController->setPluginManager($pluginManager);

        $this->assertEquals('redirect', $taskController->todoAction());
    }

    private function getRowsetTask()
    {
        $task = new Task();
        $task->setId(1);
        $task->setTitle('Test');
        $task->setDescription('Test');
        $task->setStatus('done');

        return array($task);
    }
}
