<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PageConfigPolices Model
 *
 * @method \App\Model\Entity\PageConfigPolice get($primaryKey, $options = [])
 * @method \App\Model\Entity\PageConfigPolice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PageConfigPolice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigPolice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageConfigPolice|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageConfigPolice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigPolice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigPolice findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PageConfigPolicesTable extends Table
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

        $this->setTable('page_config_polices');
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
            ->scalar('nom_police')
            ->maxLength('nom_police', 100)
            ->requirePresence('nom_police', 'create')
            ->notEmpty('nom_police');

        $validator
            ->scalar('css_specification')
            ->maxLength('css_specification', 250)
            ->allowEmpty('css_specification');

        $validator
            ->scalar('url_police')
            ->maxLength('url_police', 250)
            ->requirePresence('url_police', 'create')
            ->notEmpty('url_police');

        return $validator;
    }
}
