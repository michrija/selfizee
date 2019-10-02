<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReponsesPageSouvenirsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReponsesPageSouvenirsTable Test Case
 */
class ReponsesPageSouvenirsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReponsesPageSouvenirsTable
     */
    public $ReponsesPageSouvenirs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reponses_page_souvenirs',
        'app.champ_options',
        'app.champs',
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
        $config = TableRegistry::getTableLocator()->exists('ReponsesPageSouvenirs') ? [] : ['className' => ReponsesPageSouvenirsTable::class];
        $this->ReponsesPageSouvenirs = TableRegistry::getTableLocator()->get('ReponsesPageSouvenirs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReponsesPageSouvenirs);

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
