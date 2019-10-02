<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeImprimantes Model
 *
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\HasMany $ConfigurationBornes
 *
 * @method \App\Model\Entity\TypeImprimante get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeImprimante newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeImprimante[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeImprimante|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeImprimante|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeImprimante patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeImprimante[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeImprimante findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TypeImprimantesTable extends Table
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

        $this->setTable('type_imprimantes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ConfigurationBornes', [
            'foreignKey' => 'type_imprimante_id'
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
}
