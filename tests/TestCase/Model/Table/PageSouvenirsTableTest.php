<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PageSouvenirsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PageSouvenirsTable Test Case
 */
class PageSouvenirsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PageSouvenirsTable
     */
    public $PageSouvenirs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.page_souvenirs',
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
        $config = TableRegistry::getTableLocator()->exists('PageSouvenirs') ? [] : ['className' => PageSouvenirsTable::class];
        $this->PageSouvenirs = TableRegistry::getTableLocator()->get('PageSouvenirs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PageSouvenirs);

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
