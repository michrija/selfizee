<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientsModelesSmssTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientsModelesSmssTable Test Case
 */
class ClientsModelesSmssTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientsModelesSmssTable
     */
    public $ClientsModelesSmss;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clients_modeles_smss',
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
        $config = TableRegistry::getTableLocator()->exists('ClientsModelesSmss') ? [] : ['className' => ClientsModelesSmssTable::class];
        $this->ClientsModelesSmss = TableRegistry::getTableLocator()->get('ClientsModelesSmss', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientsModelesSmss);

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
