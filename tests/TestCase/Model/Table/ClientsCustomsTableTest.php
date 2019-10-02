<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientsCustomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientsCustomsTable Test Case
 */
class ClientsCustomsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientsCustomsTable
     */
    public $ClientsCustoms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clients_customs',
        'app.clients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ClientsCustoms') ? [] : ['className' => ClientsCustomsTable::class];
        $this->ClientsCustoms = TableRegistry::getTableLocator()->get('ClientsCustoms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientsCustoms);

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
