<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeOptinsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeOptinsTable Test Case
 */
class TypeOptinsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeOptinsTable
     */
    public $TypeOptins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.type_optins'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeOptins') ? [] : ['className' => TypeOptinsTable::class];
        $this->TypeOptins = TableRegistry::getTableLocator()->get('TypeOptins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeOptins);

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
