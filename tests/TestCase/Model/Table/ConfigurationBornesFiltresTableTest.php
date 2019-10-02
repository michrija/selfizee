<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigurationBornesFiltresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigurationBornesFiltresTable Test Case
 */
class ConfigurationBornesFiltresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigurationBornesFiltresTable
     */
    public $ConfigurationBornesFiltres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configuration_bornes_filtres',
        'app.filtres',
        'app.configuration_bornes_old'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ConfigurationBornesFiltres') ? [] : ['className' => ConfigurationBornesFiltresTable::class];
        $this->ConfigurationBornesFiltres = TableRegistry::getTableLocator()->get('ConfigurationBornesFiltres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfigurationBornesFiltres);

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
