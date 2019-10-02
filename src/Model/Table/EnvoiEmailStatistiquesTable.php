<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnvoiEmailStatistiques Model
 *
 * @property \App\Model\Table\EnvoisTable|\Cake\ORM\Association\BelongsTo $Envois
 *
 * @method \App\Model\Entity\EnvoiEmailStatistique get($primaryKey, $options = [])
 * @method \App\Model\Entity\EnvoiEmailStatistique newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EnvoiEmailStatistique[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiEmailStatistique|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnvoiEmailStatistique|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnvoiEmailStatistique patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiEmailStatistique[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiEmailStatistique findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnvoiEmailStatistiquesTable extends Table
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

        $this->setTable('envoi_email_statistiques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Envois', [
            'foreignKey' => 'envoi_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('OpenEmailStatistiques', [
            'className' => 'EnvoiEmailStatistiques',
            'conditions' => ['SentEmailStatistiques.event_type'=>"open"]
        ]);
        
        /*$this->hasMany('SentEmailStatistiques', [
            'className' => 'EnvoiEmailStatistiques',
            'conditions' => ['SentEmailStatistiques.event_type'=>"sent"]
        ]);*/
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
            ->scalar('event_type')
            ->maxLength('event_type', 250)
            ->requirePresence('event_type', 'create')
            ->notEmpty('event_type');

        $validator
            ->dateTime('date_event')
            ->allowEmpty('date_event');

        $validator
            ->scalar('error')
            ->maxLength('error', 250)
            ->allowEmpty('error');

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
        $rules->add($rules->existsIn(['envoi_id'], 'Envois'));

        return $rules;
    }
}
