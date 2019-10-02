<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvoiStatistiquesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvoiStatistiquesTable Test Case
 */
class EnvoiStatistiquesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvoiStatistiquesTable
     */
    public $EnvoiStatistiques;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.envoi_statistiques',
        'app.envois'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EnvoiStatistiques') ? [] : ['className' => EnvoiStatistiquesTable::class];
        $this->EnvoiStatistiques = TableRegistry::getTableLocator()->get('EnvoiStatistiques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnvoiStatistiques);

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
