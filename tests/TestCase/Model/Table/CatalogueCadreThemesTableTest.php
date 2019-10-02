<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CatalogueCadreThemesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CatalogueCadreThemesTable Test Case
 */
class CatalogueCadreThemesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CatalogueCadreThemesTable
     */
    public $CatalogueCadreThemes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.catalogue_cadre_themes',
        'app.catalogue_cadres',
        'app.themes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CatalogueCadreThemes') ? [] : ['className' => CatalogueCadreThemesTable::class];
        $this->CatalogueCadreThemes = TableRegistry::getTableLocator()->get('CatalogueCadreThemes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CatalogueCadreThemes);

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
