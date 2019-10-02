<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactToSendManuelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactToSendManuelsTable Test Case
 */
class ContactToSendManuelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactToSendManuelsTable
     */
    public $ContactToSendManuels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contact_to_send_manuels',
        'app.contacts',
        'app.envoi_manuels'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactToSendManuels') ? [] : ['className' => ContactToSendManuelsTable::class];
        $this->ContactToSendManuels = TableRegistry::getTableLocator()->get('ContactToSendManuels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactToSendManuels);

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
