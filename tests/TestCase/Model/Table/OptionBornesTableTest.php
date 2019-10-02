<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OptionBornesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OptionBornesTable Test Case
 */
class OptionBornesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OptionBornesTable
     */
    public $OptionBornes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.option_bornes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OptionBornes') ? [] : ['className' => OptionBornesTable::class];
        $this->OptionBornes = TableRegistry::getTableLocator()->get('OptionBornes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OptionBornes);

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
