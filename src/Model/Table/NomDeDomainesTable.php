<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NomDeDomaines Model
 *
 * @method \App\Model\Entity\NomDeDomaine get($primaryKey, $options = [])
 * @method \App\Model\Entity\NomDeDomaine newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NomDeDomaine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NomDeDomaine|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NomDeDomaine|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NomDeDomaine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NomDeDomaine[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NomDeDomaine findOrCreate($search, callable $callback = null, $options = [])
 */
class NomDeDomainesTable extends Table
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

        $this->setTable('nom_de_domaines');
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
            ->scalar('nom_de_domaine')
            ->maxLength('nom_de_domaine', 255)
            ->allowEmpty('nom_de_domaine');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        return $validator;
    }
}
