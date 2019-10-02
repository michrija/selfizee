<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersModelesEmailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersModelesEmailsTable Test Case
 */
class UsersModelesEmailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersModelesEmailsTable
     */
    public $UsersModelesEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_modeles_emails',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UsersModelesEmails') ? [] : ['className' => UsersModelesEmailsTable::class];
        $this->UsersModelesEmails = TableRegistry::getTableLocator()->get('UsersModelesEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersModelesEmails);

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
