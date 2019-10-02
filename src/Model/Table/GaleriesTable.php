<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Galeries Model
 *
 * @method \App\Model\Entity\Galery get($primaryKey, $options = [])
 * @method \App\Model\Entity\Galery newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Galery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Galery|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Galery|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Galery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Galery[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Galery findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GaleriesTable extends Table
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

        $this->setTable('galeries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasOne('Users', [
            'foreignKey' => 'galerie_id'
        ]);
        
        $this->belongsToMany('Evenements', [
            'className' => 'Evenements',
            'joinTable' => 'galeries_has_evenements',
            'targetForeignKey' =>'evenement_id',
            'foreignKey' => 'galerie_id'
        ]);
        
        $this->hasOne('GalerieCommentaires', [
            'foreignKey' => 'galerie_id'
        ]);
        
        $this->hasMany('GalerieDownloads', [
            'foreignKey' => 'galerie_id'
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
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug','create');

        $validator
            ->scalar('is_public')
            ->maxLength('is_public', 45)
            ->allowEmpty('is_public');

        $validator
            ->scalar('titre')
            ->maxLength('titre', 255)
            ->allowEmpty('titre');

        $validator
            ->scalar('sous_titre')
            ->maxLength('sous_titre', 255)
            ->allowEmpty('sous_titre');

        $validator
            ->scalar('couleur')
            ->maxLength('couleur', 45)
            ->allowEmpty('couleur');

        $validator
            ->scalar('img_banniere')
            ->maxLength('img_banniere', 255)
            ->allowEmpty('img_banniere');
            
        $validator
            ->email('email_to_notify')
            ->allowEmpty('email_to_notify');

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
       $rules->add($rules->isUnique(['slug']));

        return $rules;
    }
    
    public function findFiltre(Query $query, array $options) {

        $search = $options['key'];

        if(!empty($search)){
            $query->where(['nom LIKE' => '%'.$search.'%']);
        }
        
        $listeEvenementId = $options['listeEvenementId'];
        //debug($listeEvenementId);
        if(!empty($listeEvenementId)){
            $query->matching('Evenements', function ($q) use($listeEvenementId) {
                return $q->where(['Evenements.id IN' =>$listeEvenementId ]);
            });
        }
        return $query;
    }
}
