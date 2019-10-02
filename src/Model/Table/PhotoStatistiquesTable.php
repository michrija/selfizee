<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PhotoStatistiques Model
 *
 * @property \App\Model\Table\PhotosTable|\Cake\ORM\Association\BelongsTo $Photos
 *
 * @method \App\Model\Entity\PhotoStatistique get($primaryKey, $options = [])
 * @method \App\Model\Entity\PhotoStatistique newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PhotoStatistique[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PhotoStatistique|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PhotoStatistique|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PhotoStatistique patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PhotoStatistique[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PhotoStatistique findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PhotoStatistiquesTable extends Table
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

        $this->setTable('photo_statistiques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Photos', [
            'foreignKey' => 'photo_id',
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
            ->integer('nb_homme')
            ->allowEmpty('nb_homme');

        $validator
            ->integer('nb_femme')
            ->allowEmpty('nb_femme');

        $validator
            ->integer('moins_20')
            ->allowEmpty('moins_20');

        $validator
            ->integer('a_20_30')
            ->allowEmpty('a_20_30');

        $validator
            ->integer('a_30_40')
            ->allowEmpty('a_30_40');

        $validator
            ->integer('a_40_60')
            ->allowEmpty('a_40_60');
		
        $validator
            ->integer('plus_60')
            ->allowEmpty('plus_60');

        $validator
            ->integer('age_total')
            ->allowEmpty('age_total');

        $validator
            ->integer('nb_sourire')
            ->allowEmpty('nb_sourire');

        $validator
            ->integer('nb_neutre')
            ->allowEmpty('nb_neutre');

        $validator
            ->integer('nb_triste')
            ->allowEmpty('nb_triste');

        $validator
            ->integer('nb_surpris')
            ->allowEmpty('nb_surpris');

        $validator
            ->integer('nb_peur')
            ->allowEmpty('nb_peur');

        $validator
            ->integer('nb_colere')
            ->allowEmpty('nb_colere');

        $validator
            ->scalar('stat_globale')
            ->maxLength('stat_globale', 4294967295)
            ->allowEmpty('stat_globale');

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
        $rules->add($rules->existsIn(['photo_id'], 'Photos'));

        return $rules;
    }
}
