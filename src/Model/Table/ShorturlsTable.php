<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shorturls Model
 *
 * @property \App\Model\Table\SpdsTable|\Cake\ORM\Association\BelongsTo $Spds
 *
 * @method \App\Model\Entity\Shorturl get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shorturl newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Shorturl[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shorturl|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shorturl|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shorturl patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shorturl[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shorturl findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShorturlsTable extends Table
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

        $this->setTable('shorturls');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Spds', [
            'foreignKey' => 'spd_id'
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
            ->scalar('token')
            ->maxLength('token', 100)
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->scalar('url')
            ->requirePresence('url', 'create')
            ->notEmpty('url');

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
        $rules->add($rules->existsIn(['spd_id'], 'Spds'));

        return $rules;
    }
}
