<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FondVertsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FondVertsTable Test Case
 */
class FondVertsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FondVertsTable
     */
    public $FondVerts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fond_verts',
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
        $config = TableRegistry::getTableLocator()->exists('FondVerts') ? [] : ['className' => FondVertsTable::class];
        $this->FondVerts = TableRegistry::getTableLocator()->get('FondVerts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FondVerts);

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
