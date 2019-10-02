<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CatalogueThemes Model
 *
 * @property \App\Model\Table\CataloguesTable|\Cake\ORM\Association\BelongsTo $Catalogues
 * @property \App\Model\Table\ThemesTable|\Cake\ORM\Association\BelongsTo $Themes
 *
 * @method \App\Model\Entity\CatalogueTheme get($primaryKey, $options = [])
 * @method \App\Model\Entity\CatalogueTheme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CatalogueTheme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueTheme|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CatalogueTheme|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CatalogueTheme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueTheme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueTheme findOrCreate($search, callable $callback = null, $options = [])
 */
class CatalogueThemesTable extends Table
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

        $this->setTable('catalogue_themes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Catalogues', [
            'foreignKey' => 'catalogue_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Themes', [
            'foreignKey' => 'theme_id',
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
        $rules->add($rules->existsIn(['catalogue_id'], 'Catalogues'));
        $rules->add($rules->existsIn(['theme_id'], 'Themes'));

        return $rules;
    }
}
