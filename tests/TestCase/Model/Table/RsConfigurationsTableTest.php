<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RsConfigurationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RsConfigurationsTable Test Case
 */
class RsConfigurationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RsConfigurationsTable
     */
    public $RsConfigurations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rs_configurations',
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
        $config = TableRegistry::getTableLocator()->exists('RsConfigurations') ? [] : ['className' => RsConfigurationsTable::class];
        $this->RsConfigurations = TableRegistry::getTableLocator()->get('RsConfigurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RsConfigurations);

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
