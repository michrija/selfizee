<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EcransNavigationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EcransNavigationsTable Test Case
 */
class EcransNavigationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EcransNavigationsTable
     */
    public $EcransNavigations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ecrans_navigations',
        'app.config_bornes',
        'app.page_config_fonds',
        'app.page_config_boutons',
        'app.page_config_polices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EcransNavigations') ? [] : ['className' => EcransNavigationsTable::class];
        $this->EcransNavigations = TableRegistry::getTableLocator()->get('EcransNavigations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EcransNavigations);

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
