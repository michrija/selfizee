<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GalerieEmails Model
 *
 * @property \App\Model\Table\GaleriesTable|\Cake\ORM\Association\BelongsTo $Galeries
 *
 * @method \App\Model\Entity\GalerieEmail get($primaryKey, $options = [])
 * @method \App\Model\Entity\GalerieEmail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GalerieEmail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GalerieEmail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GalerieEmail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GalerieEmail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GalerieEmail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GalerieEmail findOrCreate($search, callable $callback = null, $options = [])
 */
class GalerieEmailsTable extends Table
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

        $this->setTable('galerie_emails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Galeries', [
            'foreignKey' => 'galerie_id'
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
            ->dateTime('date')
            ->allowEmpty('date');

        $validator
            ->scalar('destinateurs')
            ->allowEmpty('destinateurs');

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
        $rules->add($rules->existsIn(['galerie_id'], 'Galeries'));

        return $rules;
    }
}
