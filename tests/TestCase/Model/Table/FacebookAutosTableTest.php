<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacebookAutosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacebookAutosTable Test Case
 */
class FacebookAutosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FacebookAutosTable
     */
    public $FacebookAutos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.facebook_autos',
        'app.evenements',
        'app.facebook_auto_suivis'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FacebookAutos') ? [] : ['className' => FacebookAutosTable::class];
        $this->FacebookAutos = TableRegistry::getTableLocator()->get('FacebookAutos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FacebookAutos);

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
