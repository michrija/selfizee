<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnvoiManuels Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 * @property \App\Model\Table\ContactToSendManuelsTable|\Cake\ORM\Association\HasMany $ContactToSendManuels
 *
 * @method \App\Model\Entity\EnvoiManuel get($primaryKey, $options = [])
 * @method \App\Model\Entity\EnvoiManuel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EnvoiManuel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiManuel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnvoiManuel|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnvoiManuel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiManuel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiManuel findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnvoiManuelsTable extends Table
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

        $this->setTable('envoi_manuels');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ContactToSendManuels', [
            'foreignKey' => 'envoi_manuel_id'
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
            ->scalar('email_notify')
            ->maxLength('email_notify', 250)
            ->allowEmpty('email_notify');

        $validator
            ->boolean('is_email')
            ->requirePresence('is_email', 'create')
            ->notEmpty('is_email');

        $validator
            ->boolean('is_sms')
            ->requirePresence('is_sms', 'create')
            ->notEmpty('is_sms');

        $validator
            ->boolean('is_force_envoi')
            ->requirePresence('is_force_envoi', 'create')
            ->notEmpty('is_force_envoi');

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
}
