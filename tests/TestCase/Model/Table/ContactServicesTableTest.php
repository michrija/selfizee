<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactServicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactServicesTable Test Case
 */
class ContactServicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactServicesTable
     */
    public $ContactServices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contact_services'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactServices') ? [] : ['className' => ContactServicesTable::class];
        $this->ContactServices = TableRegistry::getTableLocator()->get('ContactServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactServices);

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
