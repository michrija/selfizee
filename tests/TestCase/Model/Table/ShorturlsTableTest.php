<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ShorturlsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ShorturlsTable Test Case
 */
class ShorturlsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ShorturlsTable
     */
    public $Shorturls;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.shorturls',
        'app.spds'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Shorturls') ? [] : ['className' => ShorturlsTable::class];
        $this->Shorturls = TableRegistry::getTableLocator()->get('Shorturls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Shorturls);

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
