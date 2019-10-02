<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConfigborneHasFiltres Model
 *
 * @property \App\Model\Table\ConfigBornesTable|\Cake\ORM\Association\BelongsTo $ConfigBornes
 * @property \App\Model\Table\FiltresTable|\Cake\ORM\Association\BelongsTo $Filtres
 *
 * @method \App\Model\Entity\ConfigborneHasFiltre get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfigborneHasFiltre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasFiltre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasFiltre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigborneHasFiltre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigborneHasFiltre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasFiltre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigborneHasFiltre findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfigborneHasFiltresTable extends Table
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

        $this->setTable('configborne_has_filtres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ConfigBornes', [
            'foreignKey' => 'config_borne_id'
        ]);
        $this->belongsTo('Filtres', [
            'foreignKey' => 'filtre_id'
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
        $rules->add($rules->existsIn(['config_borne_id'], 'ConfigBornes'));
        $rules->add($rules->existsIn(['filtre_id'], 'Filtres'));

        return $rules;
    }
}
