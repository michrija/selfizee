<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DispositionVignettes Model
 *
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\HasMany $ConfigurationBornes
 *
 * @method \App\Model\Entity\DispositionVignette get($primaryKey, $options = [])
 * @method \App\Model\Entity\DispositionVignette newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DispositionVignette[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DispositionVignette|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DispositionVignette|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DispositionVignette patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DispositionVignette[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DispositionVignette findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DispositionVignettesTable extends Table
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

        $this->setTable('disposition_vignettes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ConfigurationBornes', [
            'foreignKey' => 'disposition_vignette_id'
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
            ->scalar('nom')
            ->maxLength('nom', 250)
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');

        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 250)
            ->requirePresence('file_name', 'create')
            ->notEmpty('file_name');

        $validator
            ->integer('nbr_pose')
            ->requirePresence('nbr_pose', 'create')
            ->notEmpty('nbr_pose');

        return $validator;
    }
}
