<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PhotoDownloadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PhotoDownloadsTable Test Case
 */
class PhotoDownloadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PhotoDownloadsTable
     */
    public $PhotoDownloads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.photo_downloads',
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
        $config = TableRegistry::getTableLocator()->exists('PhotoDownloads') ? [] : ['className' => PhotoDownloadsTable::class];
        $this->PhotoDownloads = TableRegistry::getTableLocator()->get('PhotoDownloads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PhotoDownloads);

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
