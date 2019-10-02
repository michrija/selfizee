<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EditeurTemplatesPhotosHasTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EditeurTemplatesPhotosHasTagsTable Test Case
 */
class EditeurTemplatesPhotosHasTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EditeurTemplatesPhotosHasTagsTable
     */
    public $EditeurTemplatesPhotosHasTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.editeur_templates_photos_has_tags',
        'app.editeur_template_photos',
        'app.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EditeurTemplatesPhotosHasTags') ? [] : ['className' => EditeurTemplatesPhotosHasTagsTable::class];
        $this->EditeurTemplatesPhotosHasTags = TableRegistry::getTableLocator()->get('EditeurTemplatesPhotosHasTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EditeurTemplatesPhotosHasTags);

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
