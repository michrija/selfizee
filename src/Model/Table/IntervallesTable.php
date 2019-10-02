<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Intervalles Model
 *
 * @property \App\Model\Table\CronsTable|\Cake\ORM\Association\HasMany $Crons
 *
 * @method \App\Model\Entity\Intervalle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Intervalle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Intervalle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Intervalle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Intervalle|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Intervalle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Intervalle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Intervalle findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IntervallesTable extends Table
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

        $this->setTable('intervalles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Crons', [
            'foreignKey' => 'intervalle_id'
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
            ->scalar('intervalle')
            ->maxLength('intervalle', 255)
            ->requirePresence('intervalle', 'create')
            ->notEmpty('intervalle');

        return $validator;
    }
}
