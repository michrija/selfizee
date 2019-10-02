<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lots Model
 *
 * @method \App\Model\Entity\Lot get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Lot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lot|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lot|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lot findOrCreate($search, callable $callback = null, $options = [])
 */
class LotsTable extends Table 
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

        $this->setTable('lots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('evenement_id')
            ->maxLength('nom', 11)
            ->allowEmpty('evenement_id', 'create');

        $validator 
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->requirePresence('photo', 'create')
            ->notEmpty('photo');

        $validator
            ->integer('quantite')
            ->requirePresence('quantite', 'create')
            ->notEmpty('quantite');

        $validator
            ->scalar('type_gain')
            ->allowEmpty('type_gain');

        $validator
            ->scalar('probabilite_gain')
            ->maxLength('probabilite_gain', 255)
            ->allowEmpty('probabilite_gain');

        $validator
            ->dateTime('date_deb_gain')
            ->allowEmpty('date_deb_gain');

        return $validator;
    }

    public function findFiltre(Query $query, array $options) {

        $search = $options['cle'];

        if(!empty($search)){
            $query->where(['nom LIKE' => '%'.$search.'%']);
        }
        
        return $query;
    }
}
