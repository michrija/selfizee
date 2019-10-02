<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersModelesSmss Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UsersModelesSms get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersModelesSms newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersModelesSms[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersModelesSms|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersModelesSms|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersModelesSms patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersModelesSms[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersModelesSms findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersModelesSmssTable extends Table
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

        $this->setTable('users_modeles_smss');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->scalar('nom_modele')
            ->maxLength('nom_modele', 255)
            ->allowEmpty('nom_modele');

        $validator
            ->scalar('expediteur')
            ->maxLength('expediteur', 250)
            ->requirePresence('expediteur', 'create')
            ->notEmpty('expediteur');

        $validator
            ->scalar('contenu')
            ->requirePresence('contenu', 'create')
            ->notEmpty('contenu');

        $validator
            ->integer('nb_caractere')
            ->allowEmpty('nb_caractere');

        $validator
            ->integer('nbr_sms')
            ->allowEmpty('nbr_sms');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
