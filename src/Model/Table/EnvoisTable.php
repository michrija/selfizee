<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Envois Model
 *
 * @property \App\Model\Table\ContactsTable|\Cake\ORM\Association\BelongsTo $Contacts
 *
 * @method \App\Model\Entity\Envois get($primaryKey, $options = [])
 * @method \App\Model\Entity\Envois newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Envois[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Envois|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Envois|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Envois patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Envois[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Envois findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnvoisTable extends Table
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

        $this->setTable('envois');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Contacts', [
            'foreignKey' => 'contact_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasOne('EnvoiStatistiques', [
            'foreignKey' => 'envoi_id'
        ]);
        
        //HasMany non pas hasOne normalement
        $this->hasMany('SmsStatistiques', [
            'foreignKey' => 'envoi_id'
        ]);
        
         $this->hasMany('SmsStatistiquesDelivres', [
                'className' => 'SmsStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['SmsStatistiquesDelivres.statut' => 1])
            ->setProperty('sms_statistiques_delivres');
        
        $this->hasMany('EnvoiEmailStatistiques', [
            'foreignKey' => 'envoi_id'
        ]);
        
        $this->hasMany('EnvoiEmailStatDelivres', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatDelivres.event_type' => "sent"])
            ->setProperty('envoi_email_stat_delivres');
            
        
        $this->hasMany('EnvoiEmailStatOuvertures', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatOuvertures.event_type' => "open"])
            ->setProperty('envoi_email_stat_ouvertures');
        
        $this->hasMany('EnvoiEmailStatClicks', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatClicks.event_type' => "click"])
            ->setProperty('envoi_email_stat_clicks');
        
        $this->hasMany('EnvoiEmailStatSpams', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatSpams.event_type' => "spam"])
            ->setProperty('envoi_email_stat_spams');
            
        
        $this->hasMany('EnvoiEmailStatErreurPermanentes', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatErreurPermanentes.event_type' => "bounce",'EnvoiEmailStatErreurPermanentes.blocked' => 1,'EnvoiEmailStatErreurPermanentes.hard_bounce' => 1  ])
            ->setProperty('envoi_email_stat_erreur_permanentes');
        
        // 
        $this->hasMany('EnvoiEmailStatErreurTemporaires', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatErreurTemporaires.event_type' => "bounce",'EnvoiEmailStatErreurTemporaires.hard_bounce' => 0  ])
            ->setProperty('envoi_email_stat_erreur_permanentes');
        
        
        $this->hasMany('EnvoiEmailStatBlockeds', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatBlockeds.event_type' => "blocked" ])
            ->setProperty('envoi_email_stat_blockeds');
        
        $this->hasMany('EnvoiEmailStatBounces', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatBounces.event_type' => "bounce"])
            ->setProperty('envoi_email_stat_bounces');
            
        //unsub
         $this->hasMany('EnvoiEmailStatDesabos', [
                'className' => 'EnvoiEmailStatistiques'
            ])
            ->setForeignKey('envoi_id')
            ->setConditions(['EnvoiEmailStatDesabos.event_type' => "unsub" ])
            ->setProperty('envoi_email_stat_desabos');
        
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
            ->scalar('envoi_type')
            ->requirePresence('envoi_type', 'create')
            ->notEmpty('envoi_type');

        $validator
            ->boolean('is_force_envoi')
            ->requirePresence('is_force_envoi', 'create')
            ->notEmpty('is_force_envoi');

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
        $rules->add($rules->existsIn(['contact_id'], 'Contacts'));

        return $rules;
    }
}
