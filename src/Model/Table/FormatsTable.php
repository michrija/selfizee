<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Formats Model
 *
 * @property \App\Model\Table\CataloguesTable|\Cake\ORM\Association\HasMany $Catalogues
 * @property \App\Model\Table\ImageFondsTable|\Cake\ORM\Association\HasMany $ImageFonds
 *
 * @method \App\Model\Entity\Format get($primaryKey, $options = [])
 * @method \App\Model\Entity\Format newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Format[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Format|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Format|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Format patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Format[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Format findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FormatsTable extends Table
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

        $this->setTable('formats');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Catalogues', [
            'foreignKey' => 'format_id'
        ]);
        $this->hasMany('ImageFonds', [
            'foreignKey' => 'format_id'
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
            ->maxLength('nom', 255)
            ->allowEmpty('nom');

        return $validator;
    }
}
