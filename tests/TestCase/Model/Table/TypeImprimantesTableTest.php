<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeImprimantesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeImprimantesTable Test Case
 */
class TypeImprimantesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeImprimantesTable
     */
    public $TypeImprimantes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.type_imprimantes',
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
        $config = TableRegistry::getTableLocator()->exists('TypeImprimantes') ? [] : ['className' => TypeImprimantesTable::class];
        $this->TypeImprimantes = TableRegistry::getTableLocator()->get('TypeImprimantes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeImprimantes);

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
