<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fonctionnalites Model
 *
 * @property \App\Model\Table\FonctionaliteEvenementsTable|\Cake\ORM\Association\HasMany $FonctionaliteEvenements
 *
 * @method \App\Model\Entity\Fonctionnalite get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fonctionnalite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fonctionnalite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fonctionnalite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fonctionnalite|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fonctionnalite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fonctionnalite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fonctionnalite findOrCreate($search, callable $callback = null, $options = [])
 */
class FonctionnalitesTable extends Table
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

        $this->setTable('fonctionnalites');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('FonctionaliteEvenements', [
            'foreignKey' => 'fonctionnalite_id'
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
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->scalar('texte_helper')
            ->allowEmpty('texte_helper');

        $validator
            ->scalar('titre_link')
            ->maxLength('titre_link', 250)
            ->requirePresence('titre_link', 'create')
            ->notEmpty('titre_link');

        $validator
            ->scalar('link')
            ->maxLength('link', 250)
            ->requirePresence('link', 'create')
            ->notEmpty('link');

        $validator
            ->integer('ordre')
            ->requirePresence('ordre', 'create')
            ->notEmpty('ordre');

        return $validator;
    }
}
