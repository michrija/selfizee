<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigBornesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigBornesTable Test Case
 */
class ConfigBornesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigBornesTable
     */
    public $ConfigBornes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.config_bornes',
        'app.evenements',
        'app.type_mise_en_pages',
        'app.catalogues',
        'app.taille_ecrans',
        'app.type_imprimantes',
        'app.cadres',
        'app.champs',
        'app.configborne_has_filtres',
        'app.configborne_has_typeanimations',
        'app.ecrans',
        'app.fond_verts',
        'app.image_fond_verts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ConfigBornes') ? [] : ['className' => ConfigBornesTable::class];
        $this->ConfigBornes = TableRegistry::getTableLocator()->get('ConfigBornes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfigBornes);

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
