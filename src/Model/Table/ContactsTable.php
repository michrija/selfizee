<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contacts Model
 *
 * @property \App\Model\Table\PhotosTable|\Cake\ORM\Association\BelongsTo $Photos
 *
 * @method \App\Model\Entity\Contact get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contact newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Contact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contact|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contact|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contact[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contact findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactsTable extends Table
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

        $this->setTable('contacts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Photos', [
            'foreignKey' => 'photo_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('Envois', [
            'foreignKey' => 'contact_id'
        ]);
        
       /* $this->hasMany('SmsEnvois', [
                'className' => 'Envois'
            ])
            ->setForeignKey('contact_id')
            ->setConditions(['SmsEnvois.envoi_type' => "sms"])
            ->setProperty('sms_envois');
            
        $this->hasMany('EmailEnvois', [
                'className' => 'Envois'
            ])
            ->setForeignKey('contact_id')
            ->setConditions(['EmailEnvois.envoi_type' => "email"])
            ->setProperty('email_envois');*/
            
        $this->hasMany('ContactSmsEnvois', [
                'className' => 'Envois'
            ])
            ->setForeignKey('contact_id')
            ->setConditions(['ContactSmsEnvois.envoi_type' => "sms"])
            ->setProperty('contact_sms_envois');
            
        $this->hasMany('ContactEmailsEnvois', [
                'className' => 'Envois'
            ])
            ->setForeignKey('contact_id')
            ->setConditions(['ContactEmailsEnvois.envoi_type' => "email"])
            ->setProperty('contact_email_envois');

        $this->belongsTo('NddProposes', [
            'className' => 'NomDeDomaines',
            'foreignKey' => 'nom_de_domaine_id',
            'joinType' => 'INNER'
        ]);
            
    }

	/*public function beforeFind($event, $query, $options, $primary){
		$query->where(['Contacts.deleted_via_rgpd IS NULL OR Contacts.deleted_via_rgpd = 0']);
		return $query;
	}*/
	
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
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->allowEmpty('nom');

        $validator
            ->scalar('prenom')
            ->maxLength('prenom', 255)
            ->allowEmpty('prenom');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 255)
            ->allowEmpty('telephone');

        $validator
            ->scalar('code_pays')
            ->maxLength('code_pays', 45)
            ->allowEmpty('code_pays');

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
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['photo_id'], 'Photos'));

        return $rules;
    }
    
    
    public function findFormulaire(Query $query, array $options) {
        $listeIdPhoto = $options['listeIdPhoto'];
        if(!empty($listeIdPhoto)){
            $query->where(['Contacts.photo_id IN' =>$listeIdPhoto]);
        }else{ // Pas de photo pas de contact
            $query->where(['Contacts.photo_id <' =>-1]);
        }
		$query->where(['Contacts.deleted_via_rgpd IS NULL OR Contacts.deleted_via_rgpd = 0']); 
        
        $key = $options['key'];
        if(!empty($key)){
            $query->where(function (\Cake\Database\Expression\QueryExpression $exp) use($key) {
                $orConditions = $exp->or_(['nom LIKE' => '%'.$key.'%'])
                    ->like('prenom', '%'.$key.'%')
                    ->like('email', '%'.$key.'%')
                    ->like('telephone', '%'.$key.'%');
                    //nom, prenom, email, telephone
                return $exp
                    ->add($orConditions);
            });
        }
        
              /**
         * Opt-in
         * **/
        $is_postable_on_facebook = $options['is_postable_on_facebook'];
        if(!empty($is_postable_on_facebook)){
            $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_postable_on_facebook'=>true]);
            });
        }
        
        $is_optin_galerie = $options['is_optin_galerie'];
        if(!empty($is_optin_galerie)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_galerie'=>true]);
            });
        }
        
        $is_option_email_sms = $options['is_option_email_sms'];
        if(!empty($is_optin_galerie)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_email'=>true,'Photos.is_optin_sms'=>true]);
            });
        }
        
        $is_optin_email = $options['is_optin_email'];
        if(!empty($is_optin_email)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_email'=>true]);
            });
        }
        
        $is_optin_sms = $options['is_optin_sms'];
        if(!empty($is_optin_sms)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_sms'=>true]);
            });
        }
        
        
        $date_debut = $options['date_debut'];
        $date_fin = $options['date_fin'];
        if(!empty($date_debut) && !empty($date_fin)){
            //debug('je passe ci'); die;
            $query->matching('Photos', function ($q) use($date_debut, $date_fin) {
               return  $q->where(function ($q) use($date_debut, $date_fin) {
                    return $q->between('Photos.date_prise_photo', $date_debut, $date_fin);
                });
            });
            
        }
        
        $query->distinct(['Contacts.id']);
        
        return $query;
    }
    
    public function findFiltre(Query $query, array $options) {

        $listeIdPhoto = $options['listeIdPhoto'];
        if(!empty($listeIdPhoto)){
            $query->where(['Contacts.photo_id IN' =>$listeIdPhoto]);
        }else{ // Pas de photo pas de contact
            $query->where(['Contacts.photo_id <' =>-1]);
        }
		$query->where(['Contacts.deleted_via_rgpd IS NULL OR Contacts.deleted_via_rgpd = 0']);
        
        $key = $options['key'];
        if(!empty($key)){
            $query->where(function (\Cake\Database\Expression\QueryExpression $exp) use($key) {
                $orConditions = $exp->or_(['nom LIKE' => '%'.$key.'%'])
                    ->like('prenom', '%'.$key.'%')
                    ->like('email', '%'.$key.'%')
                    ->like('telephone', '%'.$key.'%');
                    //nom, prenom, email, telephone
                return $exp
                    ->add($orConditions);
            });
        }
        
        $emailEnvoye = $options['emailEnvoye'];
        if(!empty($emailEnvoye)){
            if($emailEnvoye == 1){
                $query->matching('Envois', function ($q) {
                    return $q->where(['Envois.envoi_type' => 'email']);
                });
            }else{
               $query->notMatching('Envois', function ($q) {
                    return $q->where(['Envois.envoi_type' => 'email']);
                });
            }
        }
        
        $smsEnvoye = $options['smsEnvoye'];
        if(!empty($smsEnvoye)){
             if($smsEnvoye == 1){
                $query->matching('Envois', function ($q) {
                    return $q->where(['Envois.envoi_type' => 'sms']);
                });
            }else{
                $query->notMatching('Envois', function ($q) {
                    return $q->where(['Envois.envoi_type' => 'sms']);
                });
            }
        }
        
        $optin = $options['optin'];
        if(!empty($optin)){
            if($optin == 1){
                $query->contain('Photos', function ($q) {
                    return $q
                        ->where(['Photos.is_postable_on_facebook' => true]);
                });
            }else{
                $query->contain('Photos', function ($q) {
                    return $q
                        ->where(['Photos.is_postable_on_facebook' => false]);
                });
            }
        }

        $emailOuvert = $options['emailOuvert'];
        if(!empty($emailOuvert)){
            if($emailOuvert == 1) {
                $query->matching('Envois.EnvoiEmailStatOuvertures');
            } else {
                $query->notMatching('Envois.EnvoiEmailStatOuvertures');
            }
        }
        
        $spam = $options['spam'];
        if(!empty($spam)){
            if($spam == 1) {
                $query->matching('Envois.EnvoiEmailStatSpams');
            } else {
                $query->notMatching('Envois.EnvoiEmailStatSpams');
            }
        }
        
        $sent = $options['sent'];
        if(!empty($sent)){ //debug($query);die;
            if($sent == 1) {
                $query->matching('Envois.EnvoiEmailStatDelivres');
            } else {
                $query->notMatching('Envois.EnvoiEmailStatDelivres');
            }
        }

        // smsDelivred - smsNotDelivred
        $smsDelivred = $options['smsDelivred'];
        if(!empty($smsDelivred)){
             if($smsDelivred == 1) {
                $query->matching('Envois.SmsStatistiques', function ($q) {
                    return $q
                        ->where(['SmsStatistiques.statut' => 1]);
                });
            } else {
            $query->matching('Envois.SmsStatistiques', function ($q) {
                    return $q
                        ->where(['SmsStatistiques.statut' => 2]);
                });                
            }

        }

        //smsClicked
        $smsClicked = $options['smsClicked'];
        if(!empty($smsClicked)){
            $query->matching('Envois.SmsStatistiques', function ($q) {
                    return $q
                        ->where(['SmsStatistiques.statut' => 3]);
                });
        }
        
        //blocked 
        $blocked = $options['blocked'];
        if(!empty($blocked)){
            if($blocked == 1) {
                $query->matching('Envois.EnvoiEmailStatBlockeds');
            } else {
                $query->notMatching('Envois.EnvoiEmailStatBlockeds');
            }
        }
        
        //hardBounce
        $hardBounce = $options['hardBounce'];
        if(!empty($hardBounce)){
            if($hardBounce == 1) {
                $query->matching('Envois.EnvoiEmailStatErreurPermanentes');
            } else {
                $query->notMatching('Envois.EnvoiEmailStatErreurPermanentes');
            }
        }
        
        //Bounce (erreur temporaire si existe countBoucnceTmp)
        $countBoucnceTmp = $options['countBoucnceTmp'];
        $bounce = $options['bounce'];
        if($bounce == 1) {
            if(!empty($countBoucnceTmp)){
                $query->matching('Envois.EnvoiEmailStatErreurTemporaires');
            }else{
                $query->where(['Contacts.id <'=>-1]);
            }
        } 
        
        
        //unsub
        $unsub = $options['unsub'];
        if(!empty($unsub)){
            if($unsub == 1) {
                $query->matching('Envois.EnvoiEmailStatDesabos');
            } else {
                $query->notMatching('Envois.EnvoiEmailStatDesabos');
            }
        }
        
        
        $emailClick = $options['emailClick'];
        if(!empty($emailClick)){
            if($emailClick == 1) {
                $query->matching('Envois.EnvoiEmailStatClicks');
            } else {
                $query->notMatching('Envois.EnvoiEmailStatClicks');
            }
        }

        $photoTelechargee = $options['photoTelechargee'];
        if(!empty($photoTelechargee)){
            if($photoTelechargee == 1) {
                $query->matching('Photos.PhotoDownloads');
            } else {
                $query->notMatching('Photos.PhotoDownloads');
            }
        }
        
        $customSort = $options['customSort'];
        if(!empty($customSort)){
            $idEnvoiEmail = $options['idEnvoiEmail'];
            $idConctatEmailDelivre = $options['idConctatEmailDelivre'] ;
            $idConctatEmailOuvert = $options['idConctatEmailOuvert'];
            $idConctatEmailClique = $options['idConctatEmailClique'];
            $idContactSmsEnvoye = $options['idContactSmsEnvoye'];   
            $listeIdPhotoDownloaded = $options['listeIdPhotoDownloaded'] ;
            $idContactSmsDelivre = $options['idContactSmsDelivre'];
        
            $direction = strtoupper($options['customDirection']);
            $orderDirection = 'ASC';
            if($direction == 'DESC'){
                $orderDirection = "DESC";
            }
            if($customSort == 'emailEnvoye' && !empty($idEnvoiEmail)){
                $idEnvoiEmail = array_unique($idEnvoiEmail);
                $idEnvoiEmail = implode(",", $idEnvoiEmail);
                $query->order(['FIELD(Contacts.id, '.$idEnvoiEmail.')' => $orderDirection]);
            }else if($customSort == 'emailDelivre' && !empty($idConctatEmailDelivre)){
                $idConctatEmailDelivre = array_unique($idConctatEmailDelivre);
                $idConctatEmailDelivre = implode(",", $idConctatEmailDelivre);
                $query->order(['FIELD(Contacts.id, '.$idConctatEmailDelivre.')' => $orderDirection]);
            }else if($customSort == "emailOuvert" && !empty($idConctatEmailOuvert)){
                $idConctatEmailOuvert = array_unique($idConctatEmailOuvert);
                $idConctatEmailOuvert = implode(",", $idConctatEmailOuvert);
                $query->order(['FIELD(Contacts.id, '.$idConctatEmailOuvert.')' => $orderDirection]);
            }else if($customSort == "emailClique" && !empty($idConctatEmailClique)){
                $idConctatEmailClique = array_unique($idConctatEmailClique);
                $idConctatEmailClique = implode(",", $idConctatEmailClique);
                $query->order(['FIELD(Contacts.id, '.$idConctatEmailClique.')' => $orderDirection]);
            }else if($customSort == 'smsEnvoye' && !empty($idContactSmsEnvoye)){
                $idContactSmsEnvoye = array_unique($idContactSmsEnvoye);
                $idContactSmsEnvoye = implode(",", $idContactSmsEnvoye);
                $query->order(['FIELD(Contacts.id, '.$idContactSmsEnvoye.')' => $orderDirection]);
            }else if($customSort == "download" && !empty($listeIdPhotoDownloaded)){
                $listeIdPhotoDownloaded = array_unique($listeIdPhotoDownloaded);
                $listeIdPhotoDownloaded = implode(",", $listeIdPhotoDownloaded);
                $query->order(['FIELD(Contacts.photo_id, '.$listeIdPhotoDownloaded.')' => $orderDirection]);
            }else if($customSort == 'dateHeurePrisePhoto'){
                $query->order(['Photos.date_prise_photo' => $orderDirection, 'Photos.heure_prise_photo' => $orderDirection ]);
            }else if($customSort == 'smsDelivre' && !empty($idContactSmsDelivre)){
                $idContactSmsDelivre = array_unique($idContactSmsDelivre);
                $idContactSmsDelivre = implode(",", $idContactSmsDelivre);
                //debug($idContactSmsDelivre);
                $query->order(['FIELD(Contacts.id, '.$idContactSmsDelivre.')' => $orderDirection]);
            }
        }
        
        /**
         * Opt-in
         * **/
        $is_postable_on_facebook = $options['is_postable_on_facebook'];
        if(!empty($is_postable_on_facebook)){
            $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_postable_on_facebook'=>true]);
            });
        }
        
        $is_optin_galerie = $options['is_optin_galerie'];
        if(!empty($is_optin_galerie)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_galerie'=>true]);
            });
        }
        
        $is_option_email_sms = $options['is_option_email_sms'];
        if(!empty($is_optin_galerie)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_email'=>true,'Photos.is_optin_sms'=>true]);
            });
        }
        
        $is_optin_email = $options['is_optin_email'];
        if(!empty($is_optin_email)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_email'=>true]);
            });
        }
        
        $is_optin_sms = $options['is_optin_sms'];
        if(!empty($is_optin_sms)){
             $query->matching('Photos', function ($q) {
                    return $q->where(['Photos.is_optin_sms'=>true]);
            });
        }
        
        
        $query->contain(['Photos.PhotoDownloads' => ['sort' => ['PhotoDownloads.created' => 'DESC']]]);
        
        $query->distinct(['Contacts.id']);
        
        return $query;
    }

    public function findFiltreWs(Query $query, array $options) {

        $listeIdPhoto = $options['listeIdPhoto'];
        if(!empty($listeIdPhoto)){
            $query->where(['Contacts.photo_id IN' =>$listeIdPhoto]);
        }else{ // Pas de photo pas de contact
            $query->where(['Contacts.photo_id <' =>-1]);
        }
        
        $query->distinct(['Contacts.id']);
        
        return $query;
    }
}
