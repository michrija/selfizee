<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InfosDownloadsGalerieSouvenirsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InfosDownloadsGalerieSouvenirsTable Test Case
 */
class InfosDownloadsGalerieSouvenirsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InfosDownloadsGalerieSouvenirsTable
     */
    public $InfosDownloadsGalerieSouvenirs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.infos_downloads_galerie_souvenirs',
        'app.galeries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InfosDownloadsGalerieSouvenirs') ? [] : ['className' => InfosDownloadsGalerieSouvenirsTable::class];
        $this->InfosDownloadsGalerieSouvenirs = TableRegistry::getTableLocator()->get('InfosDownloadsGalerieSouvenirs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InfosDownloadsGalerieSouvenirs);

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
