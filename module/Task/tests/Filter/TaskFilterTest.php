<?php
namespace TaskTest\Filter;

use PHPUnit_Framework_TestCase;
use Intercon\Challenge\Task\Filter\TaskFilter;

class TaskFilterTest extends PHPUnit_Framework_TestCase
{
    /*
     * Tests For Login Field
     */
    public function testFilterStripTagsFromTitle()
    {
        $data = array('title' => '<a>teste</a>');

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertTrue($inputFilter->isValid());
        $this->assertEquals('teste', $inputFilter->getValue('title'));
    }

    public function testFilterStripTrimFromTitle()
    {
        $data = array('title' => ' teste ');

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertTrue($inputFilter->isValid());
        $this->assertEquals('teste', $inputFilter->getValue('title'));
    }

    public function testFilterFailIfNoTitleIsSupplied()
    {
        $data = array('title' => null);

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertFalse($inputFilter->isValid());
        $this->assertArrayHasKey('title', $inputFilter->getMessages());
        $this->assertArrayHasKey('isEmpty', $inputFilter->getMessages()['title']);
    }

    public function testFilterFailIfEmptyTitleIsSupplied()
    {
        $data = array('title' => ' ');

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertFalse($inputFilter->isValid());
        $this->assertArrayHasKey('title', $inputFilter->getMessages());
        $this->assertArrayHasKey('isEmpty', $inputFilter->getMessages()['title']);
    }

    public function testFilterFailIfBigTitleIsSupplied()
    {
        $data = array(
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Quisque fringilla arcu vitae ante pellentesque euismod. Nunc facilisis egestas velit vel mattis.
            Etiam id odio gravida, tincidunt leo sit amet, consequat lectus. Vivamus porttitor tortor id volutpat.',
        );

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertFalse($inputFilter->isValid());
        $this->assertArrayHasKey('title', $inputFilter->getMessages());
        $this->assertArrayHasKey('stringLengthTooLong', $inputFilter->getMessages()['title']);
    }

    /*
     * Tests For Description Field
     */

    public function testDescriptionIsNotRequired()
    {
        $data = array();

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertFalse($inputFilter->isValid());
        $this->assertArrayNotHasKey('description', $inputFilter->getMessages());
    }

    public function testFilterStripTrimFromDescription()
    {
        $data = array('description' => ' teste ');

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertFalse($inputFilter->isValid());
        $this->assertEquals('teste', $inputFilter->getValue('description'));
    }

    /*
     * Tests For Id Field
     */
    public function testIdIsNotRequired()
    {
        $data = array();

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertFalse($inputFilter->isValid());
        $this->assertArrayNotHasKey('id', $inputFilter->getMessages());
    }

    /*
     * Tests For Status Field
     */
    public function testStatusIsNotRequired()
    {
        $data = array();

        $inputFilter = new TaskFilter();
        $inputFilter->setData($data);

        $this->assertFalse($inputFilter->isValid());
        $this->assertArrayNotHasKey('status', $inputFilter->getMessages());
    }

}
