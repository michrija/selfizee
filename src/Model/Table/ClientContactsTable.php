<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientContacts Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\ClientContact get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientContact newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClientContact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientContact|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientContact|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientContact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientContact[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientContact findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientContactsTable extends Table
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

        $this->setTable('client_contacts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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
            ->scalar('nom')
            ->maxLength('nom', 250)
            ->allowEmpty('nom');

        $validator
            ->scalar('prenom')
            ->maxLength('prenom', 250)
            ->allowEmpty('prenom');

        $validator
            ->scalar('position')
            ->maxLength('position', 250)
            ->allowEmpty('position');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 250)
            ->allowEmpty('tel');

        $validator
            ->integer('id_in_sellsy')
            ->requirePresence('id_in_sellsy', 'create')
            ->notEmpty('id_in_sellsy');

        $validator
            ->boolean('deleted_in_sellsy')
            ->allowEmpty('deleted_in_sellsy');

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
        $rules->add($rules->existsIn(['client_id'], 'Clients'));

        return $rules;
    }
}
