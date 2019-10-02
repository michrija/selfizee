<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomOptinsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomOptinsTable Test Case
 */
class CustomOptinsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomOptinsTable
     */
    public $CustomOptins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.custom_optins',
        'app.champs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CustomOptins') ? [] : ['className' => CustomOptinsTable::class];
        $this->CustomOptins = TableRegistry::getTableLocator()->get('CustomOptins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomOptins);

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
