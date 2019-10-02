<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Filtres Model
 *
 * @property |\Cake\ORM\Association\BelongsToMany $ConfigurationBornes
 *
 * @method \App\Model\Entity\Filtre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Filtre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Filtre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Filtre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filtre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filtre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Filtre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Filtre findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FiltresTable extends Table
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

        $this->setTable('filtres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('ConfigurationBornes', [
            'foreignKey' => 'filtre_id',
            'targetForeignKey' => 'configuration_borne_id',
            'joinTable' => 'configuration_bornes_filtres'
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
            ->allowEmpty('nom');

        $validator
            ->integer('filtre_type')
            ->requirePresence('filtre_type', 'create')
            ->notEmpty('filtre_type');

        return $validator;
    }
}
