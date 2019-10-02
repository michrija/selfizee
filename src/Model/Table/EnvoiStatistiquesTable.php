<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnvoiStatistiques Model
 *
 * @property \App\Model\Table\EnvoisTable|\Cake\ORM\Association\BelongsTo $Envois
 *
 * @method \App\Model\Entity\EnvoiStatistique get($primaryKey, $options = [])
 * @method \App\Model\Entity\EnvoiStatistique newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EnvoiStatistique[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiStatistique|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnvoiStatistique|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnvoiStatistique patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiStatistique[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EnvoiStatistique findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnvoiStatistiquesTable extends Table
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

        $this->setTable('envoi_statistiques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Envois', [
            'foreignKey' => 'envoi_id',
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
            ->boolean('is_opened')
            ->allowEmpty('is_opened');

        $validator
            ->dateTime('opened_at')
            ->allowEmpty('opened_at');

        $validator
            ->dateTime('arrived_at')
            ->allowEmpty('arrived_at');

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
        $rules->add($rules->existsIn(['envoi_id'], 'Envois'));

        return $rules;
    }
}
