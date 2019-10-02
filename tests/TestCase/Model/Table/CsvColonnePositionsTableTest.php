<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CsvColonnePositionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CsvColonnePositionsTable Test Case
 */
class CsvColonnePositionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CsvColonnePositionsTable
     */
    public $CsvColonnePositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.csv_colonne_positions',
        'app.csv_colonnes',
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
        $config = TableRegistry::getTableLocator()->exists('CsvColonnePositions') ? [] : ['className' => CsvColonnePositionsTable::class];
        $this->CsvColonnePositions = TableRegistry::getTableLocator()->get('CsvColonnePositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CsvColonnePositions);

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
