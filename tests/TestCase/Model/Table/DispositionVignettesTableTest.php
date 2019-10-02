<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DispositionVignettesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DispositionVignettesTable Test Case
 */
class DispositionVignettesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DispositionVignettesTable
     */
    public $DispositionVignettes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.disposition_vignettes',
        'app.configuration_bornes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DispositionVignettes') ? [] : ['className' => DispositionVignettesTable::class];
        $this->DispositionVignettes = TableRegistry::getTableLocator()->get('DispositionVignettes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DispositionVignettes);

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
