<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConfigurationBornesFiltres Model
 *
 * @property \App\Model\Table\FiltresTable|\Cake\ORM\Association\BelongsTo $Filtres
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 *
 * @method \App\Model\Entity\ConfigurationBornesFiltre get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfigurationBornesFiltre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfigurationBornesFiltre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationBornesFiltre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigurationBornesFiltre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigurationBornesFiltre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationBornesFiltre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationBornesFiltre findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfigurationBornesFiltresTable extends Table
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

        $this->setTable('configuration_bornes_filtres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Filtres', [
            'foreignKey' => 'filtre_id'
        ]);
        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id'
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
        $rules->add($rules->existsIn(['filtre_id'], 'Filtres'));
        $rules->add($rules->existsIn(['configuration_borne_id'], 'ConfigurationBornes'));

        return $rules;
    }
}
