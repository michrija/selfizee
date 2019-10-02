<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactToSendManuels Model
 *
 * @property \App\Model\Table\ContactsTable|\Cake\ORM\Association\BelongsTo $Contacts
 * @property \App\Model\Table\EnvoiManuelsTable|\Cake\ORM\Association\BelongsTo $EnvoiManuels
 *
 * @method \App\Model\Entity\ContactToSendManuel get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContactToSendManuel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContactToSendManuel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactToSendManuel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactToSendManuel|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactToSendManuel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContactToSendManuel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactToSendManuel findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactToSendManuelsTable extends Table
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

        $this->setTable('contact_to_send_manuels');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Contacts', [
            'foreignKey' => 'contact_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EnvoiManuels', [
            'foreignKey' => 'envoi_manuel_id',
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
        $rules->add($rules->existsIn(['contact_id'], 'Contacts'));
        $rules->add($rules->existsIn(['envoi_manuel_id'], 'EnvoiManuels'));

        return $rules;
    }
}
