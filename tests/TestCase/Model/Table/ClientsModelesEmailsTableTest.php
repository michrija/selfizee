<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientsModelesEmailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientsModelesEmailsTable Test Case
 */
class ClientsModelesEmailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientsModelesEmailsTable
     */
    public $ClientsModelesEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clients_modeles_emails',
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
        $config = TableRegistry::getTableLocator()->exists('ClientsModelesEmails') ? [] : ['className' => ClientsModelesEmailsTable::class];
        $this->ClientsModelesEmails = TableRegistry::getTableLocator()->get('ClientsModelesEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientsModelesEmails);

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
