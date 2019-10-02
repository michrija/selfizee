<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimelinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimelinesTable Test Case
 */
class TimelinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimelinesTable
     */
    public $Timelines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.timelines',
        'app.evenements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Timelines') ? [] : ['className' => TimelinesTable::class];
        $this->Timelines = TableRegistry::getTableLocator()->get('Timelines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Timelines);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
