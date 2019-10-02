<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CatalogueThemesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CatalogueThemesTable Test Case
 */
class CatalogueThemesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CatalogueThemesTable
     */
    public $CatalogueThemes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.catalogue_themes',
        'app.catalogues',
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
        $config = TableRegistry::getTableLocator()->exists('CatalogueThemes') ? [] : ['className' => CatalogueThemesTable::class];
        $this->CatalogueThemes = TableRegistry::getTableLocator()->get('CatalogueThemes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CatalogueThemes);

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
