<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DownloadConfigurationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DownloadConfigurationsTable Test Case
 */
class DownloadConfigurationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DownloadConfigurationsTable
     */
    public $DownloadConfigurations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.download_configurations',
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
        $config = TableRegistry::getTableLocator()->exists('DownloadConfigurations') ? [] : ['className' => DownloadConfigurationsTable::class];
        $this->DownloadConfigurations = TableRegistry::getTableLocator()->get('DownloadConfigurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DownloadConfigurations);

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
