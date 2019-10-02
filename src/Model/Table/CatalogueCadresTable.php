<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CatalogueCadres Model
 *
 * @property \App\Model\Table\FormatsTable|\Cake\ORM\Association\BelongsTo $Formats
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 * @property \App\Model\Table\CatalogueCadreThemesTable|\Cake\ORM\Association\HasMany $CatalogueCadreThemes
 *
 * @method \App\Model\Entity\CatalogueCadre get($primaryKey, $options = [])
 * @method \App\Model\Entity\CatalogueCadre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CatalogueCadre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueCadre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CatalogueCadre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CatalogueCadre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueCadre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueCadre findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CatalogueCadresTable extends Table
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

        $this->setTable('catalogue_cadres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Formats', [
            'foreignKey' => 'format_id'
        ]);
        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id'
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id'
        ]);
        
        /*$this->hasMany('CatalogueCadreThemes', [
            'foreignKey' => 'catalogue_cadre_id'
        ]);*/
        
        $this->belongsToMany('Themes', [
            'className' => 'Themes',
            'through' => 'CatalogueCadreThemes',
            'joinTable' => 'catalogue_cadre_themes',
            'foreignKey' => 'catalogue_cadre_id',
            'targetForeignKey' => 'theme_id'
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
            ->scalar('titre')
            ->maxLength('titre', 255)
            ->allowEmpty('titre');

        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 255)
            ->allowEmpty('file_name');

        $validator
            ->scalar('nom_origine')
            ->maxLength('nom_origine', 255)
            ->allowEmpty('nom_origine');

        $validator
            ->scalar('chemin')
            ->allowEmpty('chemin');

        $validator
            ->integer('nbr_pose')
            ->allowEmpty('nbr_pose');

        $validator
            ->scalar('type_cadre')
            ->maxLength('type_cadre', 255)
            ->allowEmpty('type_cadre');

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
        $rules->add($rules->existsIn(['format_id'], 'Formats'));
        $rules->add($rules->existsIn(['evenement_id'], 'Evenements'));

        return $rules;
    }
}
