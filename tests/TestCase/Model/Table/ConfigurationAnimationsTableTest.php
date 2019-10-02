<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigurationAnimationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigurationAnimationsTable Test Case
 */
class ConfigurationAnimationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigurationAnimationsTable
     */
    public $ConfigurationAnimations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configuration_animations',
        'app.disposition_vignettes',
        'app.configuration_bornes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ConfigurationAnimations') ? [] : ['className' => ConfigurationAnimationsTable::class];
        $this->ConfigurationAnimations = TableRegistry::getTableLocator()->get('ConfigurationAnimations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfigurationAnimations);

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
