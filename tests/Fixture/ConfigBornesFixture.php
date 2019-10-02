<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConfigBornesFixture
 *
 */
class ConfigBornesFixture extends TestFixture
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
        'type_mise_en_page_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'catalogue_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'decompte_prise_photo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_reprise_photo' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'is_incrustation_fond_vert' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'is_prise_coordonnee' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'titre_formulaire' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'is_impression' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'is_multi_impression' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nbr_max_multi_impression' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'has_limite_impression' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nbr_max_photo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'texte_impression' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'is_impression_auto' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nbr_copie_impression_auto' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'decompte_time_out' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'num_borne' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'taille_ecran_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'type_imprimante_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_config_bornes_evenement' => ['type' => 'index', 'columns' => ['evenement_id'], 'length' => []],
            'FK_config_bornes_mise_en_page' => ['type' => 'index', 'columns' => ['type_mise_en_page_id'], 'length' => []],
            'FK_config_bornes_catalogue' => ['type' => 'index', 'columns' => ['catalogue_id'], 'length' => []],
            'FK_config_bornes_type_impirmante' => ['type' => 'index', 'columns' => ['type_imprimante_id'], 'length' => []],
            'FK_config_bornes_taille_ecran' => ['type' => 'index', 'columns' => ['taille_ecran_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_config_bornes_catalogue' => ['type' => 'foreign', 'columns' => ['catalogue_id'], 'references' => ['catalogues', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_config_bornes_evenement' => ['type' => 'foreign', 'columns' => ['evenement_id'], 'references' => ['evenements', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_config_bornes_mise_en_page' => ['type' => 'foreign', 'columns' => ['type_mise_en_page_id'], 'references' => ['type_mise_en_pages', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_config_bornes_taille_ecran' => ['type' => 'foreign', 'columns' => ['taille_ecran_id'], 'references' => ['taille_ecrans', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_config_bornes_type_impirmante' => ['type' => 'foreign', 'columns' => ['type_imprimante_id'], 'references' => ['type_imprimantes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'type_mise_en_page_id' => 1,
                'catalogue_id' => 1,
                'decompte_prise_photo' => 1,
                'is_reprise_photo' => 1,
                'is_incrustation_fond_vert' => 1,
                'is_prise_coordonnee' => 1,
                'titre_formulaire' => 'Lorem ipsum dolor sit amet',
                'is_impression' => 1,
                'is_multi_impression' => 1,
                'nbr_max_multi_impression' => 1,
                'has_limite_impression' => 1,
                'nbr_max_photo' => 1,
                'texte_impression' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_impression_auto' => 1,
                'nbr_copie_impression_auto' => 1,
                'decompte_time_out' => 1,
                'num_borne' => 1,
                'taille_ecran_id' => 1,
                'type_imprimante_id' => 1
            ],
        ];
        parent::init();
    }
}
