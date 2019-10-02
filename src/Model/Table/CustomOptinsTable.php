<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomOptins Model
 *
 * @property \App\Model\Table\ChampsTable|\Cake\ORM\Association\BelongsTo $Champs
 *
 * @method \App\Model\Entity\CustomOptin get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomOptin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CustomOptin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomOptin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomOptin|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomOptin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomOptin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomOptin findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomOptinsTable extends Table
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

        $this->setTable('custom_optins');
        $this->setDisplayField('int');
        $this->setPrimaryKey('int');

        $this->addBehavior('Timestamp');

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
            ->integer('int')
            ->allowEmpty('int', 'create');

        $validator
            ->scalar('titre')
            ->maxLength('titre', 250)
            ->requirePresence('titre', 'create')
            ->notEmpty('titre');

        $validator
            ->dateTime('modifed')
            ->allowEmpty('modifed');

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
