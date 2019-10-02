<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailStatistiquesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailStatistiquesTable Test Case
 */
class EmailStatistiquesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailStatistiquesTable
     */
    public $EmailStatistiques;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.email_statistiques',
        'app.evenements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EmailStatistiques') ? [] : ['className' => EmailStatistiquesTable::class];
        $this->EmailStatistiques = TableRegistry::getTableLocator()->get('EmailStatistiques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailStatistiques);

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
