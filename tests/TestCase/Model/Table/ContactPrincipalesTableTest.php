<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactPrincipalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactPrincipalesTable Test Case
 */
class ContactPrincipalesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactPrincipalesTable
     */
    public $ContactPrincipales;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contact_principales',
        'app.contact_clients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactPrincipales') ? [] : ['className' => ContactPrincipalesTable::class];
        $this->ContactPrincipales = TableRegistry::getTableLocator()->get('ContactPrincipales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactPrincipales);

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
