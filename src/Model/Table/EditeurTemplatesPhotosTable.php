<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EditeurTemplatesPhotos Model
 *
 * @property \App\Model\Table\EditeurTemplatesTable|\Cake\ORM\Association\BelongsTo $EditeurTemplates
 *
 * @method \App\Model\Entity\EditeurTemplatesPhoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\EditeurTemplatesPhoto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EditeurTemplatesPhoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EditeurTemplatesPhoto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EditeurTemplatesPhoto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EditeurTemplatesPhoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EditeurTemplatesPhoto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EditeurTemplatesPhoto findOrCreate($search, callable $callback = null, $options = [])
 */
class EditeurTemplatesPhotosTable extends Table
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

        $this->setTable('editeur_templates_photos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
      
        $this->belongsTo('EditeurTemplates', [
            'foreignKey' => 'editeur_template_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EditeurTemplatesPhotosHasTags', [
            'className' => 'EditeurTemplatesPhotosHasTags',
            'foreignKey' => 'editeur_template_photo_id'
        ]);
        $this->belongsToMany('Tags', [
            'className' => 'Tags',
            'joinTable' => 'editeur_templates_photos_has_tags',
            'targetForeignKey' =>'tag_id',
            'foreignKey' => 'editeur_template_photo_id'
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
            ->scalar('file')
            ->maxLength('file', 255)
            ->allowEmpty('file')
        ;

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
        $rules->add($rules->existsIn(['editeur_template_id'], 'EditeurTemplates'));

        return $rules;
    }
	
	public function beforeFind($event, $query, $options, $primary){
		$query->where(['EditeurTemplatesPhotos.is_deleted' => false]);
		return $query;
	}
	
	public function findTags(\Cake\ORM\Query $query, array $options)
	{
		$query
			->matching('Tags', function(\Cake\ORM\Query $q) use ($options) {
				return $q->where([
					'Tags.id IN' => $options['tag_id']
				]);
			})
			->group(['EditeurTemplatesPhotos.id']);
		return $query;
	}
	
}
