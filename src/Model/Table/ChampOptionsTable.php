<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChampOptions Model
 *
 * @property \App\Model\Table\ChampsTable|\Cake\ORM\Association\BelongsTo $Champs
 *
 * @method \App\Model\Entity\ChampOption get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChampOption newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChampOption[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChampOption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChampOption|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChampOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChampOption[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChampOption findOrCreate($search, callable $callback = null, $options = [])
 */
class ChampOptionsTable extends Table
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

        $this->setTable('champ_options');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Champs', [
            'foreignKey' => 'champ_id',
            'joinType' => 'INNER'
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
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['champ_id'], 'Champs'));

        return $rules;
    }
}
