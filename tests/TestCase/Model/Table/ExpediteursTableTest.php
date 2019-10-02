<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpediteursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpediteursTable Test Case
 */
class ExpediteursTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpediteursTable
     */
    public $Expediteurs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expediteurs',
        'app.clients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Expediteurs') ? [] : ['className' => ExpediteursTable::class];
        $this->Expediteurs = TableRegistry::getTableLocator()->get('Expediteurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Expediteurs);

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
