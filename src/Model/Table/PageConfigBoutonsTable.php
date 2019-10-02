<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PageConfigBoutons Model
 *
 * @method \App\Model\Entity\PageConfigBouton get($primaryKey, $options = [])
 * @method \App\Model\Entity\PageConfigBouton newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PageConfigBouton[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigBouton|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageConfigBouton|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageConfigBouton patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigBouton[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PageConfigBouton findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PageConfigBoutonsTable extends Table
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

        $this->setTable('page_config_boutons');
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
            ->scalar('tag')
            ->maxLength('tag', 60)
            ->allowEmpty('tag');

        $validator
            ->scalar('fichier')
            ->maxLength('fichier', 120)
            ->requirePresence('fichier', 'create')
            ->notEmpty('fichier');

        return $validator;
    }
}
