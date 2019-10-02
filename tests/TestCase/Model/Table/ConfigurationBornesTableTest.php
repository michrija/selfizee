<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigurationBornesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigurationBornesTable Test Case
 */
class ConfigurationBornesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigurationBornesTable
     */
    public $ConfigurationBornes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configuration_bornes',
        'app.evenements',
        'app.type_animations',
        'app.multiconfigurations',
        'app.type_imprimantes',
        'app.model_bornes',
        'app.cadres',
        'app.champs',
        'app.ecrans',
        'app.filtre_configuration_bornes',
        'app.fond_verts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ConfigurationBornes') ? [] : ['className' => ConfigurationBornesTable::class];
        $this->ConfigurationBornes = TableRegistry::getTableLocator()->get('ConfigurationBornes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfigurationBornes);

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
