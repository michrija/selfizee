<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HistoriqueConnexionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HistoriqueConnexionsTable Test Case
 */
class HistoriqueConnexionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HistoriqueConnexionsTable
     */
    public $HistoriqueConnexions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.historique_connexions',
        'app.users',
        'app.galeries',
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
        $config = TableRegistry::getTableLocator()->exists('HistoriqueConnexions') ? [] : ['className' => HistoriqueConnexionsTable::class];
        $this->HistoriqueConnexions = TableRegistry::getTableLocator()->get('HistoriqueConnexions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HistoriqueConnexions);

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
