<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Themes Model
 *
 * @property \App\Model\Table\CataloguesTable|\Cake\ORM\Association\HasMany $Catalogues
 * @property \App\Model\Table\ImageFondsTable|\Cake\ORM\Association\HasMany $ImageFonds
 *
 * @method \App\Model\Entity\Theme get($primaryKey, $options = [])
 * @method \App\Model\Entity\Theme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Theme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Theme|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Theme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Theme findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ThemesTable extends Table
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

        $this->setTable('themes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        /*$this->hasMany('Catalogues', [
            'foreignKey' => 'theme_id'
        ]);*/
        $this->hasMany('ImageFonds', [
            'foreignKey' => 'theme_id'
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
