<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenTime;

/**
 * Evenements Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\CronsTable|\Cake\ORM\Association\HasMany $Crons
 * @property \App\Model\Table\EmailConfigurationsTable|\Cake\ORM\Association\HasMany $EmailConfigurations
 * @property \App\Model\Table\PageSouvenirsTable|\Cake\ORM\Association\HasMany $PageSouvenirs
 * @property \App\Model\Table\PhotosTable|\Cake\ORM\Association\HasMany $Photos
 * @property |\Cake\ORM\Association\HasMany $RsConfigurations
 * @property \App\Model\Table\SmsConfigurationsTable|\Cake\ORM\Association\HasMany $SmsConfigurations
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Evenement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Evenement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Evenement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Evenement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Evenement|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Evenement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Evenement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Evenement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EvenementsTable extends Table
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

        $this->setTable('evenements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        // $this->addBehavior('CounterCache', [
        //     'Photos' => [
        //         'photo_count' => [
        //             'conditions' => ['Photos.deleted' => 0, 'Photos.is_in_corbeille' => 0,'Photos.is_validate' => true]
        //         ]
        //     ]
        // ]);

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER'
        ]);
        $this->hasOne('Crons', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->hasOne('EmailConfigurations', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->hasOne('EvenementPolitiques', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->hasOne('PageSouvenirs', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->hasMany('Photos', [
            'foreignKey' => 'evenement_id',
            'conditions' => ['Photos.deleted' => 0, 'Photos.is_in_corbeille' => 0,'Photos.is_validate' => true]
        ]);
        $this->hasMany('PhotosTotal', [
            'className' => 'Photos',
            'foreignKey' => 'evenement_id',
            'conditions' => ['PhotosTotal.deleted' => 0, 'PhotosTotal.is_in_corbeille' => 0]
        ]);
        $this->hasOne('RsConfigurations', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->hasOne('SmsConfigurations', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->hasOne('Users', [
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->belongsToMany('Galeries', [
            'className' => 'Galeries',
            'joinTable' => 'galeries_has_evenements',
            'targetForeignKey' =>'galerie_id',
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->hasMany('FacebookAutos', [
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->hasOne('Crons', [
            'foreignKey' => 'evenement_id'
        ]);

        $this->hasOne('CronsProgrammes', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasOne('EmailEnvois', [
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->hasOne('SmsEnvois', [
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->hasOne('ContactEvenements', [
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->hasMany('Timelines', [
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->hasOne('EmailStatistiques', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->hasOne('EvenementCreas', [
            'foreignKey' => 'evenement_id'
        ]);
        
        $this->hasOne('ConfigurationBornes', [
            'foreignKey' => 'evenement_id'
        ]);

        $this->hasMany('Timelines', [
            'foreignKey' => 'evenement_id',
            'conditions' =>  ['Timelines.queue !=' => ""],
            'sort' => ['Timelines.queue' => 'DESC']
        ]);

        $this->hasMany('TimelinesUploadPhotos', [
            'className' => 'Timelines',
            'foreignKey' => 'evenement_id',
            'conditions' =>  ['TimelinesUploadPhotos.type_timeline =' => 1],
            'sort' => ['TimelinesUploadPhotos.queue' => 'DESC']
        ]);

        $this->hasMany('TimelinesImportContacts', [
            'className' => 'Timelines',
            'foreignKey' => 'evenement_id',
            'conditions' =>  ['TimelinesImportContacts.type_timeline =' => 2],
            'sort' => ['TimelinesImportContacts.queue' => 'DESC']
        ]);

        $this->hasMany('TimelinesEnvoiMails', [
            'className' => 'Timelines',
            'foreignKey' => 'evenement_id',
            'conditions' =>  ['TimelinesEnvoiMails.type_timeline =' => 3],
            'sort' => ['TimelinesEnvoiMails.queue' => 'DESC']
        ]);

        $this->hasMany('TimelinesEnvoiSmss', [
            'className' => 'Timelines',
            'foreignKey' => 'evenement_id',
            'conditions' =>  ['TimelinesEnvoiSmss.type_timeline =' => 4],
            'sort' => ['TimelinesEnvoiSmss.queue' => 'DESC']
        ]);

        $this->hasMany('UsersEvents', [
            'className' => 'Users',
            'foreignKey' => 'evenement_id',
            'conditions' =>  ['UsersEvents.role_id' => 5, 'UsersEvents.is_for_event' => true]
        ]);
        
        $this->hasMany('CsvColonnePositions', [
            'foreignKey' => 'evenement_id'
        ]);
        

        $this->belongsToMany('Fonctionnalites', [
            'className' => 'Fonctionnalites',
            'joinTable' => 'fonctionalite_evenements',
            'targetForeignKey' =>'fonctionnalite_id',
            'foreignKey' => 'evenement_id',
            'sort' => ['Fonctionnalites.ordre' => 'ASC']
        ]);

        $this->belongsTo('TypeEvenements', [
            'foreignKey' => 'type_evenement_id',
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
            ->requirePresence('client_id');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->boolean('is_marque_blanche')
            ->allowEmpty('is_marque_blanche');

        $validator
            ->boolean('is_data_acces')
            ->allowEmpty('is_data_acces');
            
        $validator
            ->dateTime('date_debut')
            //->allowEmpty('date_debut')
            ->notEmpty('date_debut');

        $validator
            ->dateTime('date_fin')
            //->allowEmpty('date_fin')
            ->notEmpty('date_fin');
            
        
       /* $validator
            ->add('date_fin', 'date_fin', [
                'rule' => function ($value, $context){
                    //debug($context); die;

                    $dateDebutValue = $context['data']['date_debut'];
                    if(isset($dateDebutValue['year']) && isset($dateDebutValue['month']) && isset($dateDebutValue['day']) ){
                        $date = $dateDebutValue['year'].'-'.$dateDebutValue['month'].'-'.$dateDebutValue['day'].' '.$dateDebutValue['hour'].':'.$dateDebutValue['minute']; 
                        $dateDebutValueTime = strtotime($date);
                       
                        
                        $valueDateTime  = strtotime($value['year'].'-'.$value['month'].'-'.$value['day'].' '.$value['hour'].':'.$value['minute']); 
                      
                        if($valueDateTime > $dateDebutValueTime){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return true;
                    }
                    
                    
                },
                'message' => 'La date de fin doit être supérieure à la date de début.'
            ]);*/

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
        $rules->add($rules->isUnique(['nom']));
        $rules->add($rules->existsIn(['client_id'], 'Clients'));
        $rules->add($rules->isUnique(['slug','code_logiciel']));

        return $rules;
    }
    
    public function findFiltre(Query $query, array $options) {

        $search = $options['key'];

        if(!empty($search)){
            //$query->where(['nom LIKE' => '%'.$search.'%']);
            $query->where(function (QueryExpression $exp) use($search) {
               
                $orConditions = $exp->or_(function ($or) use($search) {
                    return $or->like('Evenements.nom', '%'.$search.'%')
                        ->like('Evenements.slug', '%'.$search.'%')
                        ->eq('Evenements.id', $search);
                });
               
                return $exp
                    ->add($orConditions);
            });
        }

        $clientId = $options['clientId'];
        if(!empty($clientId)){
            $query->where(['Evenements.client_id'=>$clientId]);
        }
        
        $clientType = $options['clientType'];
        if(!empty($clientType)){
           $query->contain('Clients', function ($q) use($clientType) {
                return $q
                    ->where(['Clients.client_type' => $clientType]);
            });
        }
        
        
        $photoExiste = $options['photoExiste'];
        if(!empty($photoExiste)){
             if($photoExiste == 1){
                $query->matching('Photos');
            }else{
                $query->notMatching('Photos');
            }
        }
        
        $fbAutoConf = $options['fbAutoConf'];
        if(!empty($fbAutoConf)){
             if($fbAutoConf == 1){
                $query->matching('FacebookAutos');
            }else{
                $query->notMatching('FacebookAutos');
            }
        }
        
        $pageSouv = $options['pageSouv'];
        if(!empty($pageSouv)){
             if($pageSouv == 1){
                $query->matching('PageSouvenirs');
            }else{
                $query->notMatching('PageSouvenirs');
            }
        } 
        
        $emailConf = $options['emailConf'];
        if(!empty($emailConf)){
             if($emailConf == 1){
                $query->matching('EmailConfigurations');
            }else{
                $query->notMatching('EmailConfigurations');
            }
        }  
        
        $smsConf = $options['smsConf'];
        if(!empty($smsConf)){
             if($smsConf == 1){
                $query->matching('SmsConfigurations');
            }else{
                $query->notMatching('SmsConfigurations');
            }
        }   
        
        $envoiConf = $options['envoiConf'];
        if(!empty($envoiConf)){
             if($envoiConf == 1){
                $query->matching('Crons');
            }else{
                $query->notMatching('Crons');
            }
        }   
    
        $isGlobal = $options['isGlobal'];
        if(!$isGlobal){
            $passe = $options['passe'];
            if(!empty($passe)){ // Passe
                if($passe == 1){
                    //$query->where(['Evenements.date_fin <' => Time::now()]);
                    $query->where(function ($exp) {
                        $date = new Date();
                        $dateFormat =  $date->format('Y-m-d');
                         $orConditions = $exp->or_([/*'DATE(Evenements.date_fin) >=' => $dateFormat,*/'DATE(Evenements.date_debut) >'=> $dateFormat]);
                         //$orConditions = $exp->or_(['DATE(Evenements.date_fin) >=' => $dateFormat,'DATE(Evenements.date_debut) <='=> $dateFormat]);
                         $exp->add($orConditions);
                        /*$exp->gte('DATE(date_fin)', $dateFormat);
                        $exp->lte('DATE(date_debut)', $dateFormat);*/
                        return $exp;
                    });
                    
                    
                }
            }else{ //Avenir
                //$query->where(['Evenements.date_fin <=' => Time::now()]);
                    
                    
                    $query->where(function ($exp) {
                        $date = new Date();
                        $dateFormat =  $date->format('Y-m-d');
                        $orConditionEncours = $exp->and_(['DATE(Evenements.date_fin) >=' => $dateFormat, 'DATE(Evenements.date_debut) <='=> $dateFormat]);
                        //$exp->add($orConditionEncours);
                        
                        $passeCondition = $exp->or_(['DATE(Evenements.date_fin) <' => $dateFormat]);
                        
                        //return $exp;
                        
                        /*return $exp->or_([
                            $exp->and_([$orConditionEncours, $passeCondition])
                        ]);*/
                        
                        return $exp->or_([$orConditionEncours, $passeCondition]);
                    });
                //debug($query);die;
            }
        }
        

        /*$date = $options['date'];
        if(!empty($date)){
            //$query->where(['Evenements.date_debut IN'=>$date]);
            $date2 = date("Y-m-d", strtotime($date. "+1 days"));
            $query->where(function ($q) use($date, $date2) {
                return $q->between('Evenements.date_debut', $date, $date2);
            });
        }*/

        $date_debut = $options['date_debut'];
        $date_fin = $options['date_fin'];
        if(!empty($date_debut) && !empty($date_fin)){
            /*$query->where(['date_debut >='=>$date_debut]);
            $query->where(['date_fin =<'=>$date_fin]);*/
            $query->where(function ($q) use($date_debut, $date_fin) {
                $q->between('Evenements.date_debut', $date_debut, $date_fin);
                return $q->between('Evenements.date_fin', $date_debut, $date_fin);
            });
        }

        $periodeType = $options['periodeType'];
        if(!empty($periodeType)){
            $periodeType = explode('_', $periodeType);
            if($periodeType['0'] == "w"){
                $query->where(function ($exp) use ($periodeType) {
                    $orConditions = $exp->or_(['WEEK(Evenements.date_debut) ='=> $periodeType['1'], 'WEEK(Evenements.date_fin) ='=> $periodeType['1']]);
                    $exp->add($orConditions);
                    return $exp;
                });

            } elseif($periodeType['0'] == "m"){
                $query->where(function ($exp) use ($periodeType) {
                    $orConditions = $exp->or_(['MONTH(Evenements.date_debut) ='=> $periodeType['1'], 'MONTH(Evenements.date_fin) ='=> $periodeType['1']]);
                    $exp->add($orConditions);
                    return $exp;
                });
            }
        }

        /*$query->matching('PhotosTotal.Contacts', function ($q) {
            return $q->contain('Envois', function ($q) {
                return $q->where(['Envois.envoi_type' => 'sms'])->order(['Envois.id'=> 'DESC'])->limit(1);
            });
        });*/

        /*$query->contain('PhotosTotal', function ($q)  {
            return $q->select(['PhotosTotal.evenement_id', 'count' => $q->func()->count('PhotosTotal.id')])->group('PhotosTotal.evenement_id');
        });

        $query->contain('PhotosTotal.ContactsTotal', function ($q) {
            return $q->select(['ContactsTotal.photo_id', 'count' => $q->func()->count('ContactsTotal.id')])->group('ContactsTotal.photo_id');
        });*/

        //debug($query);die;

        $query->where(['Evenements.deleted' => false]);
        $query->group(['Evenements.id']);

        return $query;
    }
}
