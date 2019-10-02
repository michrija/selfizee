<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SmsStatistiques Model
 *
 * @property \App\Model\Table\EnvoisTable|\Cake\ORM\Association\BelongsTo $Envois
 *
 * @method \App\Model\Entity\SmsStatistique get($primaryKey, $options = [])
 * @method \App\Model\Entity\SmsStatistique newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SmsStatistique[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SmsStatistique|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsStatistique|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsStatistique patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SmsStatistique[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SmsStatistique findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SmsStatistiquesTable extends Table
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

        $this->setTable('sms_stats'); //$this->setTable('sms_statistiques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Envois', [
            'foreignKey' => 'envoi_id',
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
            ->integer('statut')
            ->requirePresence('statut', 'create')
            ->notEmpty('statut');

        $validator
            ->scalar('errormsg')
            ->maxLength('errormsg', 200)
            ->allowEmpty('errormsg');

        $validator
            ->scalar('ar')
            ->maxLength('ar', 200)
            ->allowEmpty('ar');

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
        $rules->add($rules->existsIn(['envoi_id'], 'Envois'));

        return $rules;
    }
}
