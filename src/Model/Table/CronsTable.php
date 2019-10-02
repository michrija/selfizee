<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Crons Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 * @property \App\Model\Table\IntervallesTable|\Cake\ORM\Association\BelongsTo $Intervalles
 *
 * @method \App\Model\Entity\Cron get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cron newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cron[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cron|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cron|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cron patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cron[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cron findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CronsTable extends Table
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

        $this->setTable('crons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
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
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->boolean('is_cron_email')
            ->requirePresence('is_cron_email', 'create')
            ->notEmpty('is_cron_email');

        $validator
            ->boolean('is_cron_sms')
            ->requirePresence('is_cron_sms', 'create')
            ->notEmpty('is_cron_sms');

        $validator
            ->dateTime('date_debut')
            ->requirePresence('date_debut', 'create')
            ->notEmpty('date_debut');

        $validator
            ->dateTime('date_fin')
            ->requirePresence('date_fin', 'create')
            ->notEmpty('date_fin');
            
        $validator
            ->add('date_fin', 'date_fin', [
                'rule' => function ($value, $context){
                    $dateDebutValue = $context['data']['date_debut'];
                    $date = $dateDebutValue['year'].'-'.$dateDebutValue['month'].'-'.$dateDebutValue['day'].' '.$dateDebutValue['hour'].':'.$dateDebutValue['minute']; 
                    $dateDebutValueTime = strtotime($date);
                   
                    
                    $valueDateTime  = strtotime($value['year'].'-'.$value['month'].'-'.$value['day'].' '.$value['hour'].':'.$value['minute']); 
                  
                    if($valueDateTime > $dateDebutValueTime){
                        return true;
                    }else{
                        return false;
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
}
