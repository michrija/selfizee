<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CronsProgrammesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CronsProgrammesTable Test Case
 */
class CronsProgrammesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CronsProgrammesTable
     */
    public $CronsProgrammes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.crons_programmes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CronsProgrammes') ? [] : ['className' => CronsProgrammesTable::class];
        $this->CronsProgrammes = TableRegistry::getTableLocator()->get('CronsProgrammes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CronsProgrammes);

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
