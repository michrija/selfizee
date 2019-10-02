<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientsSignaturesEmailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientsSignaturesEmailsTable Test Case
 */
class ClientsSignaturesEmailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientsSignaturesEmailsTable
     */
    public $ClientsSignaturesEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clients_signatures_emails',
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
        $config = TableRegistry::getTableLocator()->exists('ClientsSignaturesEmails') ? [] : ['className' => ClientsSignaturesEmailsTable::class];
        $this->ClientsSignaturesEmails = TableRegistry::getTableLocator()->get('ClientsSignaturesEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientsSignaturesEmails);

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
