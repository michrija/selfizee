<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeDonneesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeDonneesTable Test Case
 */
class TypeDonneesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeDonneesTable
     */
    public $TypeDonnees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.type_donnees',
        'app.champs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeDonnees') ? [] : ['className' => TypeDonneesTable::class];
        $this->TypeDonnees = TableRegistry::getTableLocator()->get('TypeDonnees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeDonnees);

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
