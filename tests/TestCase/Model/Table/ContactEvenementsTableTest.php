<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactEvenementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactEvenementsTable Test Case
 */
class ContactEvenementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactEvenementsTable
     */
    public $ContactEvenements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contact_evenements',
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
        $config = TableRegistry::getTableLocator()->exists('ContactEvenements') ? [] : ['className' => ContactEvenementsTable::class];
        $this->ContactEvenements = TableRegistry::getTableLocator()->get('ContactEvenements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactEvenements);

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
