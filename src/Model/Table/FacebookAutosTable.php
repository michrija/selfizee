<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FacebookAutos Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 * @property \App\Model\Table\FacebookAutoSuivisTable|\Cake\ORM\Association\HasMany $FacebookAutoSuivis
 *
 * @method \App\Model\Entity\FacebookAuto get($primaryKey, $options = [])
 * @method \App\Model\Entity\FacebookAuto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FacebookAuto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FacebookAuto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacebookAuto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacebookAuto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FacebookAuto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FacebookAuto findOrCreate($search, callable $callback = null, $options = [])
 */
class FacebookAutosTable extends Table
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

        $this->setTable('facebook_autos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('FacebookAutoSuivis', [
            'foreignKey' => 'facebook_auto_id'
        ]);
        
        $this->belongsTo('Intervalles', [
            'foreignKey' => 'intervalle_id',
            'joinType' => 'INNER'
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
            ->scalar('id_in_facebook')
            ->maxLength('id_in_facebook', 250)
            ->requirePresence('id_in_facebook', 'create')
            ->notEmpty('id_in_facebook');

        $validator
            ->scalar('token_facebook')
            ->maxLength('token_facebook', 4294967295)
            ->allowEmpty('token_facebook');

        $validator
            ->scalar('id_album_in_facebook')
            ->maxLength('id_album_in_facebook', 250)
            ->allowEmpty('id_album_in_facebook');

        $validator
            ->scalar('name_in_facebook')
            ->maxLength('name_in_facebook', 250)
            ->allowEmpty('name_in_facebook');

        $validator
            ->scalar('name_album_in_facebook')
            ->maxLength('name_album_in_facebook', 250)
            ->allowEmpty('name_album_in_facebook');
        
        $validator
            ->add('date_fin', 'date_fin', [
                'rule' => function ($value, $context){
                    $dateDebutValue = $context['data']['date_debut'];
                    $date = $dateDebutValue['year'].'-'.$dateDebutValue['month'].'-'.$dateDebutValue['day'].' '.$dateDebutValue['hour'].':'.$dateDebutValue['minute']; 
                    $dateDebutValueTime = strtotime($date);
                   
                    
                    $valueDateTime  = strtotime($value['year'].'-'.$value['month'].'-'.$value['day'].' '.$value['hour'].':'.$value['minute']); 
                  
                    if($context['data']['is_active']){
                        if($valueDateTime > $dateDebutValueTime){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                            return true;
                    }
                },
                'message' => 'La date de fin doit être suppérieur à la date de début.'
            ]);

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
        $rules->add($rules->existsIn(['intervalle_id'], 'Intervalles'));
        return $rules;
    }
    
    public function findFiltre(Query $query, array $options) {

        $idEvenement = $options['idEvenement'];

        if(!empty($idEvenement)){
            $query->where(['evenement_id' => $idEvenement]);
        }

        return $query;
    }
}
