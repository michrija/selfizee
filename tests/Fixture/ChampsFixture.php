<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChampsFixture
 *
 */
class ChampsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'type_champ_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nom' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'type_donnee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ordre' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'configuration_borne_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_champs' => ['type' => 'index', 'columns' => ['type_champ_id'], 'length' => []],
            'FK_champs_donne' => ['type' => 'index', 'columns' => ['type_donnee_id'], 'length' => []],
            'FK_champs_configuration' => ['type' => 'index', 'columns' => ['configuration_borne_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_champs' => ['type' => 'foreign', 'columns' => ['type_champ_id'], 'references' => ['type_champs', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_champs_configuration' => ['type' => 'foreign', 'columns' => ['configuration_borne_id'], 'references' => ['configuration_bornes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_champs_donne' => ['type' => 'foreign', 'columns' => ['type_donnee_id'], 'references' => ['type_donnees', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'type_champ_id' => 1,
                'nom' => 'Lorem ipsum dolor sit amet',
                'type_donnee_id' => 1,
                'ordre' => 1,
                'configuration_borne_id' => 1,
                'created' => '2018-10-16 12:30:02',
                'modified' => '2018-10-16 12:30:02'
            ],
        ];
        parent::init();
    }
}
