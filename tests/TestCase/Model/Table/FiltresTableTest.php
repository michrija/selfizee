<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FiltresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FiltresTable Test Case
 */
class FiltresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FiltresTable
     */
    public $Filtres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.filtres',
        'app.filtre_configuration_bornes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Filtres') ? [] : ['className' => FiltresTable::class];
        $this->Filtres = TableRegistry::getTableLocator()->get('Filtres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Filtres);

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
