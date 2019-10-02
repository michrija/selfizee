<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GalerieCommentaires Model
 *
 * @property \App\Model\Table\GaleriesTable|\Cake\ORM\Association\BelongsTo $Galeries
 *
 * @method \App\Model\Entity\GalerieCommentaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\GalerieCommentaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GalerieCommentaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GalerieCommentaire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GalerieCommentaire|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GalerieCommentaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GalerieCommentaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GalerieCommentaire findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GalerieCommentairesTable extends Table
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

        $this->setTable('galerie_commentaires');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Galeries', [
            'foreignKey' => 'galerie_id',
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
            ->scalar('commentateur_name')
            ->maxLength('commentateur_name', 250)
            ->requirePresence('commentateur_name', 'create')
            ->notEmpty('commentateur_name');

        $validator
            ->scalar('commentaire')
            ->requirePresence('commentaire', 'create')
            ->notEmpty('commentaire');

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
        $rules->add($rules->existsIn(['galerie_id'], 'Galeries'));

        return $rules;
    }
    
    public function findFiltre(Query $query, array $options) {
        
        
        $idGalerie = $options['idGalerie'];
        if(!empty($idGalerie)){
            $query->where(['galerie_id' => $idGalerie]);
        }
      
        
        return $query;
    }
}
