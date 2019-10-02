<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailStatistiques Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\EmailStatistique get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailStatistique newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailStatistique[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailStatistique|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailStatistique|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailStatistique patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailStatistique[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailStatistique findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailStatistiquesTable extends Table
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

        $this->setTable('email_statistiques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
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
            ->numeric('opened_percent')
            ->allowEmpty('opened_percent');

        $validator
            ->numeric('delivered_percent')
            ->allowEmpty('delivered_percent');

        $validator
            ->numeric('clicked_percent')
            ->allowEmpty('clicked_percent');

        $validator
            ->numeric('blocked_percent')
            ->allowEmpty('blocked_percent');

        $validator
            ->numeric('spam_percent')
            ->allowEmpty('spam_percent');

        $validator
            ->numeric('average_click_delays')
            ->allowEmpty('average_click_delays');

        $validator
            ->numeric('average_open_delays')
            ->allowEmpty('average_open_delays');

        $validator
            ->numeric('average_opened_count')
            ->allowEmpty('average_opened_count');

        $validator
            ->numeric('delivere_count')
            ->allowEmpty('delivere_count');

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
