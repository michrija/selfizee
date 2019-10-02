<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailConfigurations Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\EmailConfiguration get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailConfiguration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailConfiguration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailConfiguration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailConfiguration|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailConfiguration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailConfiguration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailConfiguration findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailConfigurationsTable extends Table
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

        $this->setTable('email_configurations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('ClientsModelesEmails', [
            'foreignKey' => 'clients_modeles_email_id'
        ]);
        
        $this->hasMany('CodePromos', [
            'foreignKey' => 'email_configuration_id',
            'saveStrategy' => 'replace'
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
