<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SmsTarifs Model
 *
 * @method \App\Model\Entity\SmsTarif get($primaryKey, $options = [])
 * @method \App\Model\Entity\SmsTarif newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SmsTarif[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SmsTarif|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsTarif|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsTarif patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SmsTarif[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SmsTarif findOrCreate($search, callable $callback = null, $options = [])
 */
class SmsTarifsTable extends Table
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

        $this->setTable('sms_tarifs');
        $this->setDisplayField('nbr_sms');
        $this->setPrimaryKey('id');
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
            ->numeric('prix')
            ->requirePresence('prix', 'create')
            ->notEmpty('prix');

        $validator
            ->integer('nbr_sms')
            ->requirePresence('nbr_sms', 'create')
            ->notEmpty('nbr_sms');

        return $validator;
    }
}
