<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImageFondsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImageFondsTable Test Case
 */
class ImageFondsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImageFondsTable
     */
    public $ImageFonds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.image_fonds',
        'app.themes',
        'app.formats',
        'app.catalogues',
        'app.configuration_animations',
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
        $config = TableRegistry::getTableLocator()->exists('ImageFonds') ? [] : ['className' => ImageFondsTable::class];
        $this->ImageFonds = TableRegistry::getTableLocator()->get('ImageFonds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ImageFonds);

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
