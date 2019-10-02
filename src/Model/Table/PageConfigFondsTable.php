<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PageConfigFonds Model
 *
 * @method \App\Model\Entity\PageConfigFond get($primaryKey, $options = [])
 * @method \App\Model\Entity\PageConfigFond newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PageConfigFond[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigFond|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageConfigFond|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageConfigFond patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigFond[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigFond findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PageConfigFondsTable extends Table
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

        $this->setTable('page_config_fonds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('couleur')
            ->maxLength('couleur', 25)
            ->requirePresence('couleur', 'create')
            ->notEmpty('couleur');

        return $validator;
    }
}
