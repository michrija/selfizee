<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvoiManuelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvoiManuelsTable Test Case
 */
class EnvoiManuelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvoiManuelsTable
     */
    public $EnvoiManuels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.envoi_manuels',
        'app.evenements',
        'app.contact_to_send_manuels'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EnvoiManuels') ? [] : ['className' => EnvoiManuelsTable::class];
        $this->EnvoiManuels = TableRegistry::getTableLocator()->get('EnvoiManuels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnvoiManuels);

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
