<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChampsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChampsTable Test Case
 */
class ChampsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChampsTable
     */
    public $Champs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.champs',
        'app.type_champs',
        'app.type_donnees',
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
        $config = TableRegistry::getTableLocator()->exists('Champs') ? [] : ['className' => ChampsTable::class];
        $this->Champs = TableRegistry::getTableLocator()->get('Champs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Champs);

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
