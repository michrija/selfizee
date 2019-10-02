<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigborneHasTypeanimationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigborneHasTypeanimationsTable Test Case
 */
class ConfigborneHasTypeanimationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigborneHasTypeanimationsTable
     */
    public $ConfigborneHasTypeanimations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configborne_has_typeanimations',
        'app.config_bornes',
        'app.type_animations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ConfigborneHasTypeanimations') ? [] : ['className' => ConfigborneHasTypeanimationsTable::class];
        $this->ConfigborneHasTypeanimations = TableRegistry::getTableLocator()->get('ConfigborneHasTypeanimations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfigborneHasTypeanimations);

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
