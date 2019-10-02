<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersCustomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersCustomsTable Test Case
 */
class UsersCustomsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersCustomsTable
     */
    public $UsersCustoms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_customs',
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
        $config = TableRegistry::getTableLocator()->exists('UsersCustoms') ? [] : ['className' => UsersCustomsTable::class];
        $this->UsersCustoms = TableRegistry::getTableLocator()->get('UsersCustoms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersCustoms);

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
