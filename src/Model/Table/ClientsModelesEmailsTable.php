<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientsModelesEmails Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\ClientsModelesEmail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientsModelesEmail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClientsModelesEmail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientsModelesEmail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientsModelesEmail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientsModelesEmail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientsModelesEmail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientsModelesEmail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientsModelesEmailsTable extends Table
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

        $this->setTable('clients_modeles_emails');
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
            ->scalar('email_expediteur')
            ->maxLength('email_expediteur', 250)
            ->allowEmpty('email_expediteur');

        $validator
            ->scalar('nom_expediteur')
            ->maxLength('nom_expediteur', 250)
            ->allowEmpty('nom_expediteur');

        $validator
            ->scalar('objet')
            ->requirePresence('objet', 'create')
            ->notEmpty('objet');

        $validator
            ->scalar('content')
            ->maxLength('content', 4294967295)
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->boolean('is_photo_en_pj')
            ->allowEmpty('is_photo_en_pj');

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
