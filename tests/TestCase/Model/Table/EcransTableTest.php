<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EcransTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EcransTable Test Case
 */
class EcransTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EcransTable
     */
    public $Ecrans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ecrans',
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
        $config = TableRegistry::getTableLocator()->exists('Ecrans') ? [] : ['className' => EcransTable::class];
        $this->Ecrans = TableRegistry::getTableLocator()->get('Ecrans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ecrans);

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
