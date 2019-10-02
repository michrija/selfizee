<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConfigurationBornes Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 * @property \App\Model\Table\TypeAnimationsTable|\Cake\ORM\Association\BelongsTo $TypeAnimations
 * @property \App\Model\Table\MulticonfigurationsTable|\Cake\ORM\Association\BelongsTo $Multiconfigurations
 * @property \App\Model\Table\TypeImprimantesTable|\Cake\ORM\Association\BelongsTo $TypeImprimantes
 * @property \App\Model\Table\ModelBornesTable|\Cake\ORM\Association\BelongsTo $ModelBornes
 * @property \App\Model\Table\CadresTable|\Cake\ORM\Association\HasMany $Cadres
 * @property \App\Model\Table\ChampsTable|\Cake\ORM\Association\HasMany $Champs
 * @property \App\Model\Table\EcransTable|\Cake\ORM\Association\HasMany $Ecrans
 * @property \App\Model\Table\FiltreConfigurationBornesTable|\Cake\ORM\Association\HasMany $FiltreConfigurationBornes
 * @property \App\Model\Table\FondVertsTable|\Cake\ORM\Association\HasMany $FondVerts
 *
 * @method \App\Model\Entity\ConfigurationBorne get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfigurationBorne newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfigurationBorne[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationBorne|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigurationBorne|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigurationBorne patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationBorne[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationBorne findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfigurationBornesTable_old extends Table
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

        $this->setTable('configuration_bornes_old');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->belongsTo('TypeAnimations', [
            'foreignKey' => 'type_animation_id',
            'joinType' => 'INNER'
        ]);
        /*$this->belongsTo('Multiconfigurations', [
            'foreignKey' => 'multiconfiguration_id'
        ]);*/
        
        $this->belongsTo('TypeImprimantes', [
            'foreignKey' => 'type_imprimante_id'
        ]);
        $this->belongsTo('ModelBornes', [
            'foreignKey' => 'model_borne_id'
        ]);
        
        $this->belongsTo('TailleEcrans', [
            'foreignKey' => 'taille_ecran_id'
        ]);
        
        
        $this->hasMany('Champs', [
            'foreignKey' => 'configuration_borne_id',
            'saveStrategy' => 'replace'
        ]);
        $this->hasOne('Ecrans', [
            'foreignKey' => 'configuration_borne_id'
        ]);
      
        $this->hasMany('FondVerts', [
            'foreignKey' => 'configuration_borne_id',
            'saveStrategy' => 'replace'
        ]);
        
        /*$this->belongsTo('DispositionVignettes', [
            'foreignKey' => 'disposition_vignette_id'
        ]);*/
        
        $this->belongsToMany('Filtres');
        
        $this->hasMany('ConfigurationAnimations', [
            'foreignKey' => 'configuration_borne_id',
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
            ->integer('nbr_pose')
            ->allowEmpty('nbr_pose');

        $validator
            ->integer('disposition_vignette')
            ->allowEmpty('disposition_vignette');

        $validator
            ->integer('decompte_prise_photo')
            ->allowEmpty('decompte_prise_photo');

        $validator
            ->integer('decompte_time_out')
            ->allowEmpty('decompte_time_out');

        $validator
            ->boolean('is_reprise_photo')
            ->allowEmpty('is_reprise_photo');

        $validator
            ->boolean('is_prise_coordonnee')
            ->allowEmpty('is_prise_coordonnee');

        $validator
            ->boolean('is_impression')
            ->allowEmpty('is_impression');

        $validator
            ->boolean('is_multi_impression')
            ->allowEmpty('is_multi_impression');

        $validator
            ->integer('nbr_max_impression')
            ->allowEmpty('nbr_max_impression');

        $validator
            ->integer('nbr_max_photo')
            ->allowEmpty('nbr_max_photo');

        $validator
            ->scalar('texte_impression')
            ->allowEmpty('texte_impression');

        $validator
            ->boolean('is_impression_auto')
            ->allowEmpty('is_impression_auto');

        $validator
            ->integer('nbr_copie_impression_auto')
            ->allowEmpty('nbr_copie_impression_auto');

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
        $rules->add($rules->existsIn(['evenement_id'], 'Evenements'));
        $rules->add($rules->existsIn(['type_animation_id'], 'TypeAnimations'));
        //$rules->add($rules->existsIn(['multiconfiguration_id'], 'Multiconfigurations'));
        $rules->add($rules->existsIn(['type_imprimante_id'], 'TypeImprimantes'));
        $rules->add($rules->existsIn(['model_borne_id'], 'ModelBornes'));

        return $rules;
    }
}
