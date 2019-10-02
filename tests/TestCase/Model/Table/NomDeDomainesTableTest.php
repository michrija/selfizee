<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NomDeDomainesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NomDeDomainesTable Test Case
 */
class NomDeDomainesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NomDeDomainesTable
     */
    public $NomDeDomaines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.nom_de_domaines'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('NomDeDomaines') ? [] : ['className' => NomDeDomainesTable::class];
        $this->NomDeDomaines = TableRegistry::getTableLocator()->get('NomDeDomaines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NomDeDomaines);

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
