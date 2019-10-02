<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CodePromos Model
 *
 * @property \App\Model\Table\EmailConfigurationsTable|\Cake\ORM\Association\BelongsTo $EmailConfigurations
 * @property |\Cake\ORM\Association\BelongsTo $Photos
 * @property |\Cake\ORM\Association\BelongsTo $Envois
 *
 * @method \App\Model\Entity\CodePromo get($primaryKey, $options = [])
 * @method \App\Model\Entity\CodePromo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CodePromo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CodePromo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CodePromo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CodePromo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CodePromo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CodePromo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CodePromosTable extends Table
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

        $this->setTable('code_promos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EmailConfigurations', [
            'foreignKey' => 'email_configuration_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Photos', [
            'foreignKey' => 'photo_id'
        ]);
        $this->belongsTo('Envois', [
            'foreignKey' => 'envoi_id'
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
            ->scalar('code_promo')
            ->maxLength('code_promo', 250)
            ->allowEmpty('code_promo');

        $validator
            ->boolean('is_deja_attribue')
            ->allowEmpty('is_deja_attribue');

        $validator
            ->dateTime('modifed')
            ->allowEmpty('modifed');

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
        $rules->add($rules->existsIn(['email_configuration_id'], 'EmailConfigurations'));
        $rules->add($rules->existsIn(['photo_id'], 'Photos'));
        $rules->add($rules->existsIn(['envoi_id'], 'Envois'));

        return $rules;
    }
}
