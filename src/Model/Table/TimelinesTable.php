<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Timelines Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\Timeline get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timeline newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Timeline[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timeline|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timeline|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timeline patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timeline[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timeline findOrCreate($search, callable $callback = null, $options = [])
 */
class TimelinesTable extends Table
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

        $this->setTable('timelines');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id'
        ]);
		$this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('nbr', 'create')
            ->notEmpty('nbr');

        $validator
            ->requirePresence('type_timeline', 'create')
            ->notEmpty('type_timeline');

        $validator
            ->dateTime('date_timeline')
            ->allowEmpty('date_timeline');

        $validator
            ->scalar('queue')
            ->maxLength('queue', 250)
            ->allowEmpty('queue');

        $validator
            ->scalar('source_timeline')
            ->maxLength('source_timeline', 250)
            ->allowEmpty('source_timeline');

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
