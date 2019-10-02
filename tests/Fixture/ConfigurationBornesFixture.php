<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConfigurationBornesFixture
 *
 */
class ConfigurationBornesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'evenement_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'type_animation_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nbr_pose' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'disposition_vignette' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'multiconfiguration_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'decompte_prise_photo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'decompte_time_out' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_reprise_photo' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'is_prise_coordonnee' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'is_impression' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'is_multi_impression' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nbr_max_impression' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nbr_max_photo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'texte_impression' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'is_impression_auto' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nbr_copie_impression_auto' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'type_imprimante_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'model_borne_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_configuration_bornes' => ['type' => 'index', 'columns' => ['evenement_id'], 'length' => []],
            'FK_configuration_bornes_animation' => ['type' => 'index', 'columns' => ['type_animation_id'], 'length' => []],
            'FK_configuration_bornes_multiconf' => ['type' => 'index', 'columns' => ['multiconfiguration_id'], 'length' => []],
            'FK_configuration_bornes_type_impirmante' => ['type' => 'index', 'columns' => ['type_imprimante_id'], 'length' => []],
            'FK_configuration_bornes_model_borne' => ['type' => 'index', 'columns' => ['model_borne_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_configuration_bornes' => ['type' => 'foreign', 'columns' => ['evenement_id'], 'references' => ['evenements', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_configuration_bornes_animation' => ['type' => 'foreign', 'columns' => ['type_animation_id'], 'references' => ['type_animations', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_configuration_bornes_model_borne' => ['type' => 'foreign', 'columns' => ['model_borne_id'], 'references' => ['model_bornes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_configuration_bornes_multiconf' => ['type' => 'foreign', 'columns' => ['multiconfiguration_id'], 'references' => ['multiconfigurations', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_configuration_bornes_type_impirmante' => ['type' => 'foreign', 'columns' => ['type_imprimante_id'], 'references' => ['type_imprimantes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'evenement_id' => 1,
                'type_animation_id' => 1,
                'nbr_pose' => 1,
                'disposition_vignette' => 1,
                'multiconfiguration_id' => 1,
                'decompte_prise_photo' => 1,
                'decompte_time_out' => 1,
                'is_reprise_photo' => 1,
                'is_prise_coordonnee' => 1,
                'is_impression' => 1,
                'is_multi_impression' => 1,
                'nbr_max_impression' => 1,
                'nbr_max_photo' => 1,
                'texte_impression' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_impression_auto' => 1,
                'nbr_copie_impression_auto' => 1,
                'type_imprimante_id' => 1,
                'model_borne_id' => 1
            ],
        ];
        parent::init();
    }
}
