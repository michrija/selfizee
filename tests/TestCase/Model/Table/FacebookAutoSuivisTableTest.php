<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacebookAutoSuivisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacebookAutoSuivisTable Test Case
 */
class FacebookAutoSuivisTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FacebookAutoSuivisTable
     */
    public $FacebookAutoSuivis;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.facebook_auto_suivis',
        'app.facebook_autos',
        'app.photos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FacebookAutoSuivis') ? [] : ['className' => FacebookAutoSuivisTable::class];
        $this->FacebookAutoSuivis = TableRegistry::getTableLocator()->get('FacebookAutoSuivis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FacebookAutoSuivis);

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
