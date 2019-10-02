<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CadresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CadresTable Test Case
 */
class CadresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CadresTable
     */
    public $Cadres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cadres',
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
        $config = TableRegistry::getTableLocator()->exists('Cadres') ? [] : ['className' => CadresTable::class];
        $this->Cadres = TableRegistry::getTableLocator()->get('Cadres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cadres);

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
