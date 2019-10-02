<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EditeurTemplatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EditeurTemplatesTable Test Case
 */
class EditeurTemplatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EditeurTemplatesTable
     */
    public $EditeurTemplates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.editeur_templates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EditeurTemplates') ? [] : ['className' => EditeurTemplatesTable::class];
        $this->EditeurTemplates = TableRegistry::getTableLocator()->get('EditeurTemplates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EditeurTemplates);

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
