<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailEnvoisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailEnvoisTable Test Case
 */
class EmailEnvoisTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailEnvoisTable
     */
    public $EmailEnvois;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.email_envois',
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
        $config = TableRegistry::getTableLocator()->exists('EmailEnvois') ? [] : ['className' => EmailEnvoisTable::class];
        $this->EmailEnvois = TableRegistry::getTableLocator()->get('EmailEnvois', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailEnvois);

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
