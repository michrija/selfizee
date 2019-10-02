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
 * @property \App\Model\Table\TypeMiseEnPagesTable|\Cake\ORM\Association\BelongsTo $TypeMiseEnPages
 * @property \App\Model\Table\CataloguesTable|\Cake\ORM\Association\BelongsTo $Catalogues
 * @property \App\Model\Table\TailleEcransTable|\Cake\ORM\Association\BelongsTo $TailleEcrans
 * @property \App\Model\Table\TypeImprimantesTable|\Cake\ORM\Association\BelongsTo $TypeImprimantes
 * @property \App\Model\Table\CadresTable|\Cake\ORM\Association\HasMany $Cadres
 * @property \App\Model\Table\ChampsTable|\Cake\ORM\Association\HasMany $Champs
 * @property \App\Model\Table\ConfigurationBornesFiltresTable|\Cake\ORM\Association\HasMany $ConfigurationBornesFiltres
 * @property \App\Model\Table\ConfigurationBornesTypeanimationsTable|\Cake\ORM\Association\HasMany $ConfigurationBornesTypeanimations
 * @property \App\Model\Table\EcransTable|\Cake\ORM\Association\HasMany $Ecrans
 * @property \App\Model\Table\FondVertsTable|\Cake\ORM\Association\HasMany $FondVerts
 * @property \App\Model\Table\ImageFondVertsTable|\Cake\ORM\Association\HasMany $ImageFondVerts
 *
 * @method \App\Model\Entity\ConfigBorne get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfigBorne newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfigBorne[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfigBorne|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigBorne|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigBorne patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigBorne[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigBorne findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfigurationBornesTable extends Table
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

        $this->setTable('configuration_bornes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->belongsTo('TypeMiseEnPages', [
            'foreignKey' => 'type_mise_en_page_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Catalogues', [
            'foreignKey' => 'catalogue_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('TailleEcrans', [
            'foreignKey' => 'taille_ecran_id'
        ]);
        $this->belongsTo('TypeImprimantes', [
            'foreignKey' => 'type_imprimante_id'
        ]);
        $this->hasMany('Cadres', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        $this->hasMany('Champs', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        /*$this->hasMany('ConfigborneHasFiltres', [
            'foreignKey' => 'config_borne_id'
        ]);*/

        $this->hasMany('ConfigurationBornesFiltres', [
            'foreignKey' => 'configuration_borne_id'
        ]);

        /*$this->hasMany('ConfigborneHasTypeanimations', [
            'foreignKey' => 'config_borne_id'
        ]);*/

        $this->hasMany('ConfigurationBornesTypeanimations', [
            'foreignKey' => 'configuration_borne_id'
        ]);

        $this->belongsToMany('Filtres', [
            'className' => 'Filtres',
            'through' => 'ConfigurationBornesFiltres',
            'joinTable' => 'configuration_bornes_fitres',
            'foreignKey' => 'configuration_borne_id',
            'targetForeignKey' => 'filtre_id'
        ]);        
        
        $this->belongsToMany('TypeAnimations', [
            'className' => 'TypeAnimations',
            'through' => 'ConfigurationBornesTypeanimations',
            'joinTable' => 'configuration_bornes_typeanimations',
            'foreignKey' => 'configuration_borne_id',
            'targetForeignKey' => 'type_animation_id'
        ]);

        $this->hasMany('Ecrans', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        $this->hasOne('EcransNavigations', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        $this->hasMany('FondVerts', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        $this->hasMany('ImageFondVerts', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        
        $this->hasMany('ConfigurationAnimations', [
            'foreignKey' => 'configuration_borne_id',
            'saveStrategy' => 'replace'
        ]);

        $this->hasMany('ConfigurationAnimations1', [
            'className' => 'ConfigurationAnimations',
            'conditions' => ['ConfigurationAnimations1.type_animation_id' => 1]
        ]);

        $this->hasMany('ConfigurationAnimations2', [
            'className' => 'ConfigurationAnimations',
            'conditions' => ['ConfigurationAnimations2.type_animation_id' => 2]
        ]);

        $this->hasMany('ConfigurationAnimations3', [
            'className' => 'ConfigurationAnimations',
            'conditions' => ['ConfigurationAnimations3.type_animation_id' =>3]
        ]);

        $this->hasMany('ConfigurationAnimations4', [
            'className' => 'ConfigurationAnimations',
            'conditions' => ['ConfigurationAnimations4.type_animation_id' => 4]
        ]);

        $this->hasMany('ConfigurationAnimations5', [
            'className' => 'ConfigurationAnimations',
            'conditions' => ['ConfigurationAnimations5.type_animation_id' => 5]
        ]);


        $this->belongsTo('ModelBornes', [
            'foreignKey' => 'model_borne_id'
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
            ->integer('decompte_prise_photo')
            ->allowEmpty('decompte_prise_photo');

        $validator
            ->boolean('is_reprise_photo')
            ->allowEmpty('is_reprise_photo');

        $validator
            ->boolean('is_incrustation_fond_vert')
            ->allowEmpty('is_incrustation_fond_vert');

        $validator
            ->boolean('is_prise_coordonnee')
            ->allowEmpty('is_prise_coordonnee');

        $validator
            ->scalar('titre_formulaire')
            ->allowEmpty('titre_formulaire');

        $validator
            ->boolean('is_impression')
            ->allowEmpty('is_impression');

        $validator
            ->boolean('is_multi_impression')
            ->allowEmpty('is_multi_impression');

        $validator
            ->integer('nbr_max_multi_impression')
            ->allowEmpty('nbr_max_multi_impression');

        $validator
            ->boolean('has_limite_impression')
            ->allowEmpty('has_limite_impression');

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

        $validator
            ->integer('decompte_time_out')
            ->allowEmpty('decompte_time_out');

        $validator
            ->scalar('num_borne')
            ->allowEmpty('num_borne');

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
        $rules->add($rules->existsIn(['type_mise_en_page_id'], 'TypeMiseEnPages'));
        $rules->add($rules->existsIn(['catalogue_id'], 'Catalogues'));
        $rules->add($rules->existsIn(['taille_ecran_id'], 'TailleEcrans'));
        $rules->add($rules->existsIn(['type_imprimante_id'], 'TypeImprimantes'));

        return $rules;
    }
}
