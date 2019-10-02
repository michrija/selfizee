<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContenusEmailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContenusEmailsTable Test Case
 */
class ContenusEmailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContenusEmailsTable
     */
    public $ContenusEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contenus_emails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContenusEmails') ? [] : ['className' => ContenusEmailsTable::class];
        $this->ContenusEmails = TableRegistry::getTableLocator()->get('ContenusEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContenusEmails);

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
