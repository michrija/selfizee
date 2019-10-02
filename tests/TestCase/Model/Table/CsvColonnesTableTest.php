<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CsvColonnesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CsvColonnesTable Test Case
 */
class CsvColonnesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CsvColonnesTable
     */
    public $CsvColonnes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.csv_colonnes',
        'app.csv_colonne_positions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CsvColonnes') ? [] : ['className' => CsvColonnesTable::class];
        $this->CsvColonnes = TableRegistry::getTableLocator()->get('CsvColonnes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CsvColonnes);

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
