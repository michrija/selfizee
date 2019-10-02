<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IntervallesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IntervallesTable Test Case
 */
class IntervallesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IntervallesTable
     */
    public $Intervalles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.intervalles',
        'app.crons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Intervalles') ? [] : ['className' => IntervallesTable::class];
        $this->Intervalles = TableRegistry::getTableLocator()->get('Intervalles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Intervalles);

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
}
