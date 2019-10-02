<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeMiseEnPagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeMiseEnPagesTable Test Case
 */
class TypeMiseEnPagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeMiseEnPagesTable
     */
    public $TypeMiseEnPages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.type_mise_en_pages',
        'app.config_bornes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeMiseEnPages') ? [] : ['className' => TypeMiseEnPagesTable::class];
        $this->TypeMiseEnPages = TableRegistry::getTableLocator()->get('TypeMiseEnPages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeMiseEnPages);

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
