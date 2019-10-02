<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ConfigBornesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ConfigBornesController Test Case
 */
class ConfigBornesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.config_bornes',
        'app.evenements',
        'app.type_mise_en_pages',
        'app.catalogues',
        'app.taille_ecrans',
        'app.type_imprimantes',
        'app.cadres',
        'app.champs',
        'app.configborne_has_filtres',
        'app.configborne_has_typeanimations',
        'app.ecrans',
        'app.fond_verts',
        'app.image_fond_verts'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
