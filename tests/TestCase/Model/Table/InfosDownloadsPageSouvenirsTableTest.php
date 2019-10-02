<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InfosDownloadsPageSouvenirsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InfosDownloadsPageSouvenirsTable Test Case
 */
class InfosDownloadsPageSouvenirsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InfosDownloadsPageSouvenirsTable
     */
    public $InfosDownloadsPageSouvenirs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.infos_downloads_page_souvenirs',
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
        $config = TableRegistry::getTableLocator()->exists('InfosDownloadsPageSouvenirs') ? [] : ['className' => InfosDownloadsPageSouvenirsTable::class];
        $this->InfosDownloadsPageSouvenirs = TableRegistry::getTableLocator()->get('InfosDownloadsPageSouvenirs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InfosDownloadsPageSouvenirs);

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
