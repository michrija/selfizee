<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersModelesSmssTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersModelesSmssTable Test Case
 */
class UsersModelesSmssTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersModelesSmssTable
     */
    public $UsersModelesSmss;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_modeles_smss',
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
        $config = TableRegistry::getTableLocator()->exists('UsersModelesSmss') ? [] : ['className' => UsersModelesSmssTable::class];
        $this->UsersModelesSmss = TableRegistry::getTableLocator()->get('UsersModelesSmss', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersModelesSmss);

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
