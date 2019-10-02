<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Licences Model
 *
 * @method \App\Model\Entity\Licence get($primaryKey, $options = [])
 * @method \App\Model\Entity\Licence newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Licence[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Licence|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Licence|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Licence patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Licence[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Licence findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LicencesTable extends Table
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

        $this->setTable('licences');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('id_borne')
            ->maxLength('id_borne', 255)
            ->allowEmpty('id_borne');

        $validator
            ->scalar('duree')
            ->maxLength('duree', 255)
            ->allowEmpty('duree');

        $validator
            ->scalar('numero_serie_non_crypte')
            ->maxLength('numero_serie_non_crypte', 255)
            ->allowEmpty('numero_serie_non_crypte');

        $validator
            ->scalar('numero_serie_crypte')
            ->allowEmpty('numero_serie_crypte');

        return $validator;
    }
}
