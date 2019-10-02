<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CodePromosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CodePromosTable Test Case
 */
class CodePromosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CodePromosTable
     */
    public $CodePromos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.code_promos',
        'app.email_configurations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CodePromos') ? [] : ['className' => CodePromosTable::class];
        $this->CodePromos = TableRegistry::getTableLocator()->get('CodePromos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CodePromos);

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
