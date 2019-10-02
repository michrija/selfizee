<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactPrincipales Model
 *
 * @property \App\Model\Table\ContactClientsTable|\Cake\ORM\Association\BelongsTo $ContactClients
 *
 * @method \App\Model\Entity\ContactPrincipale get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContactPrincipale newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContactPrincipale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactPrincipale|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactPrincipale|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactPrincipale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContactPrincipale[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactPrincipale findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactPrincipalesTable extends Table
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

        $this->setTable('contact_principales');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ContactClients', [
            'foreignKey' => 'contact_client_id'
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
            ->scalar('contact_name')
            ->maxLength('contact_name', 255)
            ->allowEmpty('contact_name');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 255)
            ->allowEmpty('adresse');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 255)
            ->allowEmpty('mobile');

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
        $rules->add($rules->isUnique(['email']));
       // $rules->add($rules->existsIn(['contact_client_id'], 'ContactClients'));

        return $rules;
    }
}
