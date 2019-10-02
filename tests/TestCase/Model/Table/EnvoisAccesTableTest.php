<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvoisAccesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvoisAccesTable Test Case
 */
class EnvoisAccesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvoisAccesTable
     */
    public $EnvoisAcces;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.envois_acces',
        'app.users',
        'app.evenements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EnvoisAcces') ? [] : ['className' => EnvoisAccesTable::class];
        $this->EnvoisAcces = TableRegistry::getTableLocator()->get('EnvoisAcces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnvoisAcces);

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
