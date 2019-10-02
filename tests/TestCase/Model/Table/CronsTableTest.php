<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CronsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CronsTable Test Case
 */
class CronsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CronsTable
     */
    public $Crons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.crons',
        'app.evenements',
        'app.intervalles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Crons') ? [] : ['className' => CronsTable::class];
        $this->Crons = TableRegistry::getTableLocator()->get('Crons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Crons);

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
