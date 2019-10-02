<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvoisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvoisTable Test Case
 */
class EnvoisTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvoisTable
     */
    public $Envois;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.envois',
        'app.contacts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Envois') ? [] : ['className' => EnvoisTable::class];
        $this->Envois = TableRegistry::getTableLocator()->get('Envois', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Envois);

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
