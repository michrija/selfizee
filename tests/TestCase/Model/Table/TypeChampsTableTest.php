<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeChampsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeChampsTable Test Case
 */
class TypeChampsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeChampsTable
     */
    public $TypeChamps;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.type_champs',
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
        $config = TableRegistry::getTableLocator()->exists('TypeChamps') ? [] : ['className' => TypeChampsTable::class];
        $this->TypeChamps = TableRegistry::getTableLocator()->get('TypeChamps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeChamps);

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
