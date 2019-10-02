<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TailleEcransTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TailleEcransTable Test Case
 */
class TailleEcransTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TailleEcransTable
     */
    public $TailleEcrans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.taille_ecrans',
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
        $config = TableRegistry::getTableLocator()->exists('TailleEcrans') ? [] : ['className' => TailleEcransTable::class];
        $this->TailleEcrans = TableRegistry::getTableLocator()->get('TailleEcrans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TailleEcrans);

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
