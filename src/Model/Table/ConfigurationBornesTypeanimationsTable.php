<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConfigurationBornesTypeanimations Model
 *
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 * @property \App\Model\Table\TypeAnimationsTable|\Cake\ORM\Association\BelongsTo $TypeAnimations
 *
 * @method \App\Model\Entity\ConfigborneHasTypeanimation get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfigborneHasTypeanimation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasTypeanimation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasTypeanimation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigborneHasTypeanimation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigborneHasTypeanimation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasTypeanimation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasTypeanimation findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfigurationBornesTypeanimationsTable extends Table
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

        $this->setTable('configuration_bornes_typeanimations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        $this->belongsTo('TypeAnimations', [
            'foreignKey' => 'type_animation_id'
        ]);
        
        //=== test :( 
        $this->hasMany('CadresAnimations', [
            'className' => 'Cadres',
            'foreignKey' => 'configuration_bornes_typeanimation_id'
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
        $rules->add($rules->existsIn(['configuration_borne_id'], 'ConfigurationBornes'));
        $rules->add($rules->existsIn(['type_animation_id'], 'TypeAnimations'));

        return $rules;
    }
}
