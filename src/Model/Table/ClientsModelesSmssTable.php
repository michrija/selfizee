<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientsModelesSmss Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\ClientsModelesSms get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientsModelesSms newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClientsModelesSms[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientsModelesSms|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientsModelesSms|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientsModelesSms patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientsModelesSms[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientsModelesSms findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientsModelesSmssTable extends Table
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

        $this->setTable('clients_modeles_smss');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id'
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
        $rules->add($rules->existsIn(['client_id'], 'Clients'));

        return $rules;
    }
}
