<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvenementStatCampaignsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvenementStatCampaignsTable Test Case
 */
class EvenementStatCampaignsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EvenementStatCampaignsTable
     */
    public $EvenementStatCampaigns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.evenement_stat_campaigns',
        'app.evenements',
        'app.sources'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EvenementStatCampaigns') ? [] : ['className' => EvenementStatCampaignsTable::class];
        $this->EvenementStatCampaigns = TableRegistry::getTableLocator()->get('EvenementStatCampaigns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EvenementStatCampaigns);

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
