<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cadres Model
 *
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 *
 * @method \App\Model\Entity\Cadre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cadre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cadre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cadre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cadre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cadre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cadre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cadre findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CadresTable extends Table
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

        $this->setTable('cadres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id',
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
            ->scalar('file_name')
            ->maxLength('file_name', 250)
            // ->requirePresence('file_name', 'create')
            ->allowEmpty('file_name');

        $validator
            ->scalar('file_overlay')
            ->maxLength('file_overlay', 120)
            ->allowEmpty('file_overlay');

        $validator
            ->integer('ordre')
            ->allowEmpty('ordre');

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
        $rules->add($rules->existsIn(['configuration_borne_id'], 'ConfigurationBornes'));

        return $rules;
    }
	
	public function beforeFind($event, $query, $options, $primary){
		$query->order(['ordre' => 'ASC']);
		return $query;
	}
	
}
