<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CsvColonnePositions Model
 *
 * @property \App\Model\Table\CsvColonnesTable|\Cake\ORM\Association\BelongsTo $CsvColonnes
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\CsvColonnePosition get($primaryKey, $options = [])
 * @method \App\Model\Entity\CsvColonnePosition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CsvColonnePosition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CsvColonnePosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CsvColonnePosition|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CsvColonnePosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CsvColonnePosition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CsvColonnePosition findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CsvColonnePositionsTable extends Table
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

        $this->setTable('csv_colonne_positions');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('CsvColonnes', [
            'foreignKey' => 'csv_colonne_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
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
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmpty('position');

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
        $rules->add($rules->existsIn(['csv_colonne_id'], 'CsvColonnes'));
        $rules->add($rules->existsIn(['evenement_id'], 'Evenements'));
        
        $rules->add($rules->isUnique(
            ['position', 'evenement_id'],
            'Cette position de colonne est déjà utlisée pour cet événement.'
        ));

        return $rules;
    }
    
     public function findFiltre(Query $query, array $options) {

        $idEvenement = $options['idEvenement'];

        if(!empty($idEvenement)){
            $query->where(['evenement_id' => $idEvenement]);
        }

        return $query;
    }
}
