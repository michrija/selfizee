<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CatalogueCadresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CatalogueCadresTable Test Case
 */
class CatalogueCadresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CatalogueCadresTable
     */
    public $CatalogueCadres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.catalogue_cadres',
        'app.formats',
        'app.evenements',
        'app.catalogue_cadre_themes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CatalogueCadres') ? [] : ['className' => CatalogueCadresTable::class];
        $this->CatalogueCadres = TableRegistry::getTableLocator()->get('CatalogueCadres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CatalogueCadres);

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
