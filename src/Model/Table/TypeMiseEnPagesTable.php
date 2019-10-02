<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeMiseEnPages Model
 *
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\HasMany $ConfigurationBornes
 *
 * @method \App\Model\Entity\TypeMiseEnPage get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeMiseEnPage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeMiseEnPage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeMiseEnPage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeMiseEnPage|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeMiseEnPage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeMiseEnPage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeMiseEnPage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TypeMiseEnPagesTable extends Table
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

        $this->setTable('type_mise_en_pages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ConfigurationBornes', [
            'foreignKey' => 'type_mise_en_page_id'
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
