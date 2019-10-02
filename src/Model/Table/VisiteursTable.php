<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Visiteurs Model
 *
 * @property \App\Model\Table\PhotosTable|\Cake\ORM\Association\HasMany $Photos
 *
 * @method \App\Model\Entity\Visiteur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Visiteur newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Visiteur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Visiteur|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visiteur|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visiteur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Visiteur[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Visiteur findOrCreate($search, callable $callback = null, $options = [])
 */
class VisiteursTable extends Table
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

        $this->setTable('visiteurs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Photos', [
            'foreignKey' => 'visiteur_id'
        ]);
        
        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id'
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
            ->scalar('full_name')
            ->maxLength('full_name', 250)
            ->requirePresence('full_name', 'create')
            ->notEmpty('full_name');

        $validator
            ->email('email')
            ->allowEmpty('email');

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

        return $rules;
    }
}
