<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Photos Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 * @property \App\Model\Table\ContactsTable|\Cake\ORM\Association\HasMany $Contacts
 *
 * @method \App\Model\Entity\Photo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Photo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Photo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Photo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Photo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Photo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Photo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Photo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PhotosTable extends Table
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

        //$this->setTable('photos');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('Contacts', [
            'foreignKey' => 'photo_id'
        ]);
        $this->hasMany('ContactsTotal', [
            'className' => 'Photos',
            'foreignKey' => 'photo_id'
        ]);
        
        $this->hasMany('PhotoCommentaires', [
            'foreignKey' => 'photo_id'
        ]);
        
        $this->hasOne('PhotoStatistiques', [
            'foreignKey' => 'photo_id'
        ]);
        
        $this->hasMany('PhotoDownloads', [
            'foreignKey' => 'photo_id'
        ]);
        
        $this->hasMany('PhotoVues', [
            'foreignKey' => 'photo_id'
        ]);
        
        $this->belongsTo('Visiteurs', [
            'foreignKey' => 'visiteur_id'
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
            ->scalar('name_origne')
            ->requirePresence('name_origne', 'create')
            ->notEmpty('name_origne');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->boolean('is_postable_on_facebook')
            ->allowEmpty('is_postable_on_facebook');

        $validator
            ->boolean('deleted')
            ->allowEmpty('deleted');

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

        return $rules;
    }
    
    public function findFiltre(Query $query, array $options) {

        $idEvenement = $options['idEvenement'];
        if(!empty($idEvenement)){
            $query->where(['Photos.evenement_id' =>$idEvenement]);
        }
        
        $corbeille = $options['corbeille'];
        if(!empty($corbeille)){
            $query->where(['Photos.is_in_corbeille'=>true]);
        }else{
            $query->where(['Photos.is_in_corbeille'=>false]);
        }
        
        $is_validate = $options['is_validate'];
        if($is_validate == '0' && !is_null($is_validate)){
            $query->where(['Photos.is_validate'=>false]);
        }
        
        
        $sourceGal = $options['sourceGal'];
        if(!empty($sourceGal)){
            if($sourceGal == 2){
                $query->where(['Photos.source_upload' => 'galerie']);
            }else{
                $query->where(['Photos.source_upload <>' => 'galerie']);
            }
        }
        
        $visiteur = $options['visiteur'];
        if(!empty($visiteur)){
            $query->where(['visiteur_id' => $visiteur]);
        }

        $periode = $options['periode'];
        if(!empty($periode)){

            $olddates = explode(' - ', $periode);
                      
            if(count($olddates) == 2) {
                $date_debut = \DateTime::createFromFormat('d/m/Y', $olddates[0])->format('Y-m-d') ;
                $date_fin =\DateTime::createFromFormat('d/m/Y', $olddates[1])->format('Y-m-d');
                
                $query->where([
                                "Photos.date_prise_photo >=" =>  $date_debut ,
                                "Photos.date_prise_photo <=" =>  $date_fin 
                            ]);
            }
        }


        $query->where(['Photos.deleted' =>false]);

        return $query;
    }
    
    public function findSouvenir(Query $query, array $options) {
        
        
        $listeIdEvenement = $options['listeIdEvenement'];
        if(!empty($listeIdEvenement)){
            $query->where(['evenement_id IN' => $listeIdEvenement]);
        }
        
        $key = $options['key'];
        if(!empty($key)){
            $query->matching('Contacts', function ($q) use ($key) {
                return $q->where(['Contacts.email LIKE' => '%'.$key.'%']);
            });
        }
        
        $dateOrder = $options['dateOrder'];
        if(empty($dateOrder)){
             $query->order(['Photos.date_prise_photo'=>'asc', 'Photos.heure_prise_photo' => 'asc']);
        }else if($dateOrder == 1){
            $query->order(['Photos.date_prise_photo'=>'desc', 'Photos.heure_prise_photo' => 'desc']);
        }
        
        $sourceGal = isset($options['sourceGal']) ? $options['sourceGal'] : [];
        if(!empty($sourceGal)){
            if($sourceGal == 2){
                $query->where(['Photos.source_upload' => 'galerie']);
            }else{
                $query->where(['Photos.source_upload <>' => 'galerie']);
            }
        }
        
        $visiteur = isset($options['visiteur']) ? $options['visiteur'] : [];
        if(!empty($visiteur)){
            $query->where(['visiteur_id' => $visiteur]);
        }
        
        $query->where(['Photos.is_validate' => true]);
        
        return $query;
    }
}
