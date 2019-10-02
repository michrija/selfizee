<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GalerieDownloadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GalerieDownloadsTable Test Case
 */
class GalerieDownloadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GalerieDownloadsTable
     */
    public $GalerieDownloads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.galerie_downloads',
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
        $config = TableRegistry::getTableLocator()->exists('GalerieDownloads') ? [] : ['className' => GalerieDownloadsTable::class];
        $this->GalerieDownloads = TableRegistry::getTableLocator()->get('GalerieDownloads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GalerieDownloads);

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
