<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EvenementStatCampaigns Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 * @property \App\Model\Table\SourcesTable|\Cake\ORM\Association\BelongsTo $Sources
 *
 * @method \App\Model\Entity\EvenementStatCampaign get($primaryKey, $options = [])
 * @method \App\Model\Entity\EvenementStatCampaign newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EvenementStatCampaign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EvenementStatCampaign|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EvenementStatCampaign|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EvenementStatCampaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EvenementStatCampaign[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EvenementStatCampaign findOrCreate($search, callable $callback = null, $options = [])
 */
class EvenementStatCampaignsTable extends Table
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

        $this->setTable('evenement_stat_campaigns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);
        /*$this->belongsTo('Sources', [
            'foreignKey' => 'source_id'
        ]);*/
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
            ->scalar('event_click_delay')
            ->maxLength('event_click_delay', 250)
            ->allowEmpty('event_click_delay');

        $validator
            ->integer('event_clicked_count')
            ->allowEmpty('event_clicked_count');

        $validator
            ->scalar('event_open_delay')
            ->maxLength('event_open_delay', 250)
            ->allowEmpty('event_open_delay');

        $validator
            ->integer('event_opened_count')
            ->allowEmpty('event_opened_count');

        $validator
            ->integer('event_spam_count')
            ->allowEmpty('event_spam_count');

        $validator
            ->integer('event_unsubscribed_count')
            ->allowEmpty('event_unsubscribed_count');

        $validator
            ->integer('event_workflow_exited_count')
            ->allowEmpty('event_workflow_exited_count');

        $validator
            ->integer('message_blocked_count')
            ->allowEmpty('message_blocked_count');

        $validator
            ->integer('message_clicked_count')
            ->allowEmpty('message_clicked_count');

        $validator
            ->integer('message_deferred_count')
            ->allowEmpty('message_deferred_count');

        $validator
            ->integer('message_hard_bounced_count')
            ->allowEmpty('message_hard_bounced_count');

        $validator
            ->integer('message_opened_count')
            ->allowEmpty('message_opened_count');

        $validator
            ->integer('message_queued_count')
            ->allowEmpty('message_queued_count');

        $validator
            ->integer('message_sent_count')
            ->allowEmpty('message_sent_count');

        $validator
            ->integer('message_soft_bounced_count')
            ->allowEmpty('message_soft_bounced_count');

        $validator
            ->integer('message_spam_count')
            ->allowEmpty('message_spam_count');

        $validator
            ->integer('message_unsubscribed_count')
            ->allowEmpty('message_unsubscribed_count');

        $validator
            ->integer('message_workflow_exited_count')
            ->allowEmpty('message_workflow_exited_count');

        $validator
            ->integer('total')
            ->allowEmpty('total');

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
        //$rules->add($rules->existsIn(['source_id'], 'Sources'));

        return $rules;
    }
}
