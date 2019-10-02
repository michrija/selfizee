<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GalerieCommentairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GalerieCommentairesTable Test Case
 */
class GalerieCommentairesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GalerieCommentairesTable
     */
    public $GalerieCommentaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.galerie_commentaires',
        'app.galeries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GalerieCommentaires') ? [] : ['className' => GalerieCommentairesTable::class];
        $this->GalerieCommentaires = TableRegistry::getTableLocator()->get('GalerieCommentaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GalerieCommentaires);

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
