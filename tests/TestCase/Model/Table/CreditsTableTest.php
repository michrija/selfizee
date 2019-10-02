<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CreditsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CreditsTable Test Case
 */
class CreditsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CreditsTable
     */
    public $Credits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.credits',
        'app.clients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Credits') ? [] : ['className' => CreditsTable::class];
        $this->Credits = TableRegistry::getTableLocator()->get('Credits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Credits);

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
