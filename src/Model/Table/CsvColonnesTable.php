<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CsvColonnes Model
 *
 * @property \App\Model\Table\CsvColonnePositionsTable|\Cake\ORM\Association\HasMany $CsvColonnePositions
 *
 * @method \App\Model\Entity\CsvColonne get($primaryKey, $options = [])
 * @method \App\Model\Entity\CsvColonne newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CsvColonne[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CsvColonne|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CsvColonne|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CsvColonne patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CsvColonne[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CsvColonne findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CsvColonnesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('csv_colonnes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CsvColonnePositions', [
            'foreignKey' => 'csv_colonne_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 250)
            ->allowEmpty('nom');

        return $validator;
    }
}
