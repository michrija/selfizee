<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SmsConfigurationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SmsConfigurationsTable Test Case
 */
class SmsConfigurationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SmsConfigurationsTable
     */
    public $SmsConfigurations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sms_configurations',
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
        $config = TableRegistry::getTableLocator()->exists('SmsConfigurations') ? [] : ['className' => SmsConfigurationsTable::class];
        $this->SmsConfigurations = TableRegistry::getTableLocator()->get('SmsConfigurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SmsConfigurations);

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
