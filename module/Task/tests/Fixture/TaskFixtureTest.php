<?php
namespace Intercon\Challenge\TaskTest\Fixture;

use Intercon\Challenge\Task\Fixture\TaskFixture;
use Intercon\Challenge\Task\Entity\Type;
use Intercon\Challenge\Task\Entity\Status;

class TaskFixtureTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadInsertCorrectValues()
    {
        $objectManager = \Mockery::mock('Doctrine\Common\Persistence\ObjectManager');
        $objectManager->shouldReceive('persist')->with(\Mockery::any())->andReturn(null);
        $objectManager->shouldReceive('flush')->with()->andReturn(null);

        $fixture = new TaskFixture();

        /** @var $objectManager \Doctrine\Common\Persistence\ObjectManager */
        $fixture->load($objectManager);
    }
}
