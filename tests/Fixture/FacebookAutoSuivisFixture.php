<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FacebookAutoSuivisFixture
 *
 */
class FacebookAutoSuivisFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'facebook_auto_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'photo_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modifed' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_facebook_auto_suivis' => ['type' => 'index', 'columns' => ['photo_id'], 'length' => []],
            'FK_facebook_auto_suivis_2' => ['type' => 'index', 'columns' => ['facebook_auto_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_facebook_auto_suivis' => ['type' => 'foreign', 'columns' => ['photo_id'], 'references' => ['photos', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_facebook_auto_suivis_2' => ['type' => 'foreign', 'columns' => ['facebook_auto_id'], 'references' => ['facebook_autos', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'facebook_auto_id' => 1,
                'photo_id' => 1,
                'created' => '2018-07-23 17:32:37',
                'modifed' => '2018-07-23 17:32:37'
            ],
        ];
        parent::init();
    }
}
