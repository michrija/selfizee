<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FonctionnalitesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FonctionnalitesTable Test Case
 */
class FonctionnalitesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FonctionnalitesTable
     */
    public $Fonctionnalites;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fonctionnalites',
        'app.fonctionalite_evenements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Fonctionnalites') ? [] : ['className' => FonctionnalitesTable::class];
        $this->Fonctionnalites = TableRegistry::getTableLocator()->get('Fonctionnalites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fonctionnalites);

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
