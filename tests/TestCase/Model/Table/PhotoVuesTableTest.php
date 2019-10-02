<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PhotoVuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PhotoVuesTable Test Case
 */
class PhotoVuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PhotoVuesTable
     */
    public $PhotoVues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.photo_vues',
        'app.photos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PhotoVues') ? [] : ['className' => PhotoVuesTable::class];
        $this->PhotoVues = TableRegistry::getTableLocator()->get('PhotoVues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PhotoVues);

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
