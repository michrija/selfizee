<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChampOptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChampOptionsTable Test Case
 */
class ChampOptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChampOptionsTable
     */
    public $ChampOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.champ_options',
        'app.champs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChampOptions') ? [] : ['className' => ChampOptionsTable::class];
        $this->ChampOptions = TableRegistry::getTableLocator()->get('ChampOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChampOptions);

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
