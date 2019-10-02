<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MulticonfigurationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MulticonfigurationsTable Test Case
 */
class MulticonfigurationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MulticonfigurationsTable
     */
    public $Multiconfigurations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.multiconfigurations',
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
        $config = TableRegistry::getTableLocator()->exists('Multiconfigurations') ? [] : ['className' => MulticonfigurationsTable::class];
        $this->Multiconfigurations = TableRegistry::getTableLocator()->get('Multiconfigurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Multiconfigurations);

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
