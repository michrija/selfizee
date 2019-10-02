<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SmsEnvoisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SmsEnvoisTable Test Case
 */
class SmsEnvoisTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SmsEnvoisTable
     */
    public $SmsEnvois;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sms_envois',
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
        $config = TableRegistry::getTableLocator()->exists('SmsEnvois') ? [] : ['className' => SmsEnvoisTable::class];
        $this->SmsEnvois = TableRegistry::getTableLocator()->get('SmsEnvois', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SmsEnvois);

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
