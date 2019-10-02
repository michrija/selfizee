<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SmsConfigurations Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\SmsConfiguration get($primaryKey, $options = [])
 * @method \App\Model\Entity\SmsConfiguration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SmsConfiguration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SmsConfiguration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsConfiguration|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsConfiguration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SmsConfiguration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SmsConfiguration findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SmsConfigurationsTable extends Table
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

        $this->setTable('sms_configurations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ClientsModelesSmss', [
            'foreignKey' => 'clients_modeles_ sms_id'
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
            ->scalar('expediteur')
            ->maxLength('expediteur', 250)
            ->requirePresence('expediteur', 'create')
            ->notEmpty('expediteur');

        $validator
            ->scalar('contenu')
            //->maxLength('contenu', 320)
            ->requirePresence('contenu', 'create')
            ->notEmpty('contenu');
            
        $validator
            ->notEmpty('date_heure_envoi', 'Veuillez saisir une date ou désactiver l \'envoi programmée', function ($context) {
                return !empty($context['data']['is_envoi_plannifie']);
            });

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
