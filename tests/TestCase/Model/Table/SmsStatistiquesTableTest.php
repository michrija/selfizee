<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SmsStatistiquesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SmsStatistiquesTable Test Case
 */
class SmsStatistiquesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SmsStatistiquesTable
     */
    public $SmsStatistiques;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sms_statistiques',
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
        $config = TableRegistry::getTableLocator()->exists('SmsStatistiques') ? [] : ['className' => SmsStatistiquesTable::class];
        $this->SmsStatistiques = TableRegistry::getTableLocator()->get('SmsStatistiques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SmsStatistiques);

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
