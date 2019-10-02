<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConfigurationAnimations Model
 *
 * @property \App\Model\Table\DispositionVignettesTable|\Cake\ORM\Association\BelongsTo $DispositionVignettes
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 *
 * @method \App\Model\Entity\ConfigurationAnimation get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfigurationAnimation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfigurationAnimation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationAnimation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigurationAnimation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigurationAnimation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationAnimation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationAnimation findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfigurationAnimationsTable extends Table
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

        $this->setTable('configuration_animations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DispositionVignettes', [
            'foreignKey' => 'disposition_vignette_id'
        ]);
        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        
        $this->belongsTo('Multiconfigurations', [
            'foreignKey' => 'multiconfiguration_id'
        ]);
        
        
        $this->hasMany('Cadres', [
            'foreignKey' => 'configuration_animation_id',
            'saveStrategy' => 'replace'
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
            ->integer('type_cadre')
            ->allowEmpty('type_cadre');

        $validator
            ->integer('nbr_pose')
            ->allowEmpty('nbr_pose');

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
        $rules->add($rules->existsIn(['disposition_vignette_id'], 'DispositionVignettes'));
        $rules->add($rules->existsIn(['configuration_borne_id'], 'ConfigurationBornes'));

        return $rules;
    }
}
