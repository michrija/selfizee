<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CronsProgrammes Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\CronsProgramme get($primaryKey, $options = [])
 * @method \App\Model\Entity\CronsProgramme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CronsProgramme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CronsProgramme|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CronsProgramme|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CronsProgramme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CronsProgramme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CronsProgramme findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CronsProgrammesTable extends Table
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

        $this->setTable('crons_programmes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->boolean('is_active_envoi_programme')
            ->requirePresence('is_active_envoi_programme', 'create')
            ->notEmpty('is_active_envoi_programme');

        $validator
            ->boolean('is_email_cron_programme')
            ->requirePresence('is_email_cron_programme', 'create')
            ->notEmpty('is_email_cron_programme');

        $validator
            ->boolean('is_sms_cron_programme')
            ->requirePresence('is_sms_cron_programme', 'create')
            ->notEmpty('is_sms_cron_programme');

        $validator
            ->dateTime('date_programme')
            ->allowEmpty('date_programme');

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
