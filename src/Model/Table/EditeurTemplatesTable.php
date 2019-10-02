<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EditeurTemplates Model
 *
 * @method \App\Model\Entity\EditeurTemplate get($primaryKey, $options = [])
 * @method \App\Model\Entity\EditeurTemplate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EditeurTemplate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EditeurTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EditeurTemplate|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EditeurTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EditeurTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EditeurTemplate findOrCreate($search, callable $callback = null, $options = [])
 */
class EditeurTemplatesTable extends Table
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

		$this->hasMany('EditeurTemplatesPhotos', [
            'className' => 'EditeurTemplatesPhotos',
            'foreignKey' => 'editeur_template_id'
        ]);
		
        $this->setTable('editeur_templates');
        $this->setDisplayField('type_editeur');
        $this->setPrimaryKey('id');
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
            ->scalar('fond')
            ->maxLength('fond', 255)
            ->allowEmpty('fond');

        $validator
            ->scalar('element')
            ->maxLength('element', 255)
            ->allowEmpty('element');

        $validator
            ->scalar('contours')
            ->maxLength('contours', 255)
            ->allowEmpty('contours');

        return $validator;
    }
}
