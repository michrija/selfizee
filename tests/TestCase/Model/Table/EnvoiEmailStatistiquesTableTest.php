<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvoiEmailStatistiquesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvoiEmailStatistiquesTable Test Case
 */
class EnvoiEmailStatistiquesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvoiEmailStatistiquesTable
     */
    public $EnvoiEmailStatistiques;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.envoi_email_statistiques',
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
        $config = TableRegistry::getTableLocator()->exists('EnvoiEmailStatistiques') ? [] : ['className' => EnvoiEmailStatistiquesTable::class];
        $this->EnvoiEmailStatistiques = TableRegistry::getTableLocator()->get('EnvoiEmailStatistiques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnvoiEmailStatistiques);

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
