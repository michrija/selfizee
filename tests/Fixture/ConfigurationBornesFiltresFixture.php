<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConfigurationBornesFiltresFixture
 *
 */
class ConfigurationBornesFiltresFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'filtre_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'configuration_borne_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_filtre_configuration_bornes' => ['type' => 'index', 'columns' => ['filtre_id'], 'length' => []],
            'FK_filtre_configuration_bornes_2' => ['type' => 'index', 'columns' => ['configuration_borne_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_filtre_configuration_bornes' => ['type' => 'foreign', 'columns' => ['filtre_id'], 'references' => ['filtres', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_filtre_configuration_bornes_2' => ['type' => 'foreign', 'columns' => ['configuration_borne_id'], 'references' => ['configuration_bornes_old', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'filtre_id' => 1,
                'configuration_borne_id' => 1
            ],
        ];
        parent::init();
    }
}
