<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Champs Model
 *
 * @property \App\Model\Table\TypeChampsTable|\Cake\ORM\Association\BelongsTo $TypeChamps
 * @property \App\Model\Table\TypeDonneesTable|\Cake\ORM\Association\BelongsTo $TypeDonnees
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 *
 * @method \App\Model\Entity\Champ get($primaryKey, $options = [])
 * @method \App\Model\Entity\Champ newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Champ[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Champ|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Champ|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Champ patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Champ[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Champ findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChampsTable extends Table
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

        $this->setTable('champs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TypeChamps', [
            'foreignKey' => 'type_champ_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TypeDonnees', [
            'foreignKey' => 'type_donnee_id'
        ]);
        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('ChampOptions', [
            'foreignKey' => 'champ_id'
        ]);
        
        $this->hasOne('CustomOptins', [
            'foreignKey' => 'champ_id'
        ]);
        
        $this->belongsTo('TypeOptins', [
            'foreignKey' => 'type_optin_id'
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
            //->requirePresence('nom', 'create')
            ->allowEmpty('nom');

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
        $rules->add($rules->existsIn(['type_champ_id'], 'TypeChamps'));
        $rules->add($rules->existsIn(['type_donnee_id'], 'TypeDonnees'));
        $rules->add($rules->existsIn(['configuration_borne_id'], 'ConfigurationBornes'));

        return $rules;
    }
}
