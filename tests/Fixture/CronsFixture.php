<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CronsFixture
 *
 */
class CronsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'is_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'is_cron_email' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'is_cron_sms' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'date_debut' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'date_fin' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'evenement_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'intervalle_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_crons_evenements1_idx' => ['type' => 'index', 'columns' => ['evenement_id'], 'length' => []],
            'fk_crons_intervalles1_idx' => ['type' => 'index', 'columns' => ['intervalle_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_crons_evenements1' => ['type' => 'foreign', 'columns' => ['evenement_id'], 'references' => ['evenements', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_crons_intervalles1' => ['type' => 'foreign', 'columns' => ['intervalle_id'], 'references' => ['intervalles', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'is_active' => 1,
                'is_cron_email' => 1,
                'is_cron_sms' => 1,
                'date_debut' => '2018-07-20 12:48:44',
                'date_fin' => '2018-07-20 12:48:44',
                'evenement_id' => 1,
                'intervalle_id' => 1,
                'created' => '2018-07-20 12:48:44',
                'modified' => '2018-07-20 12:48:44'
            ],
        ];
        parent::init();
    }
}
