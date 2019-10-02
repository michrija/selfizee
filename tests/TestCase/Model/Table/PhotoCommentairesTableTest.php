<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PhotoCommentairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PhotoCommentairesTable Test Case
 */
class PhotoCommentairesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PhotoCommentairesTable
     */
    public $PhotoCommentaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.photo_commentaires',
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
        $config = TableRegistry::getTableLocator()->exists('PhotoCommentaires') ? [] : ['className' => PhotoCommentairesTable::class];
        $this->PhotoCommentaires = TableRegistry::getTableLocator()->get('PhotoCommentaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PhotoCommentaires);

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
