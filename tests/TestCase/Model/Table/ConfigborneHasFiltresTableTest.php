<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigborneHasFiltresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigborneHasFiltresTable Test Case
 */
class ConfigborneHasFiltresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigborneHasFiltresTable
     */
    public $ConfigborneHasFiltres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configborne_has_filtres',
        'app.config_bornes',
        'app.filtres'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ConfigborneHasFiltres') ? [] : ['className' => ConfigborneHasFiltresTable::class];
        $this->ConfigborneHasFiltres = TableRegistry::getTableLocator()->get('ConfigborneHasFiltres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfigborneHasFiltres);

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
