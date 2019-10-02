<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ImageFonds Model
 *
 * @property \App\Model\Table\ThemesTable|\Cake\ORM\Association\BelongsTo $Themes
 * @property \App\Model\Table\FormatsTable|\Cake\ORM\Association\BelongsTo $Formats
 * @property \App\Model\Table\CataloguesTable|\Cake\ORM\Association\BelongsTo $Catalogues
 * @property \App\Model\Table\ConfigurationAnimationsTable|\Cake\ORM\Association\BelongsTo $ConfigurationAnimations
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 *
 * @method \App\Model\Entity\ImageFond get($primaryKey, $options = [])
 * @method \App\Model\Entity\ImageFond newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ImageFond[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ImageFond|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ImageFond|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ImageFond patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ImageFond[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ImageFond findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImageFondsTable extends Table
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

        $this->setTable('image_fonds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Themes', [
            'foreignKey' => 'theme_id'
        ]);
        $this->belongsTo('Formats', [
            'foreignKey' => 'format_id'
        ]);
        $this->belongsTo('Catalogues', [
            'foreignKey' => 'catalogue_id'
        ]);
        $this->belongsTo('ConfigurationAnimations', [
            'foreignKey' => 'configuration_animation_id'
        ]);
        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id'
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
            ->scalar('type')
            ->allowEmpty('type');

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
        $rules->add($rules->existsIn(['theme_id'], 'Themes'));
        $rules->add($rules->existsIn(['format_id'], 'Formats'));
        $rules->add($rules->existsIn(['catalogue_id'], 'Catalogues'));
        $rules->add($rules->existsIn(['configuration_animation_id'], 'ConfigurationAnimations'));
        $rules->add($rules->existsIn(['configuration_borne_id'], 'ConfigurationBornes'));

        return $rules;
    }
}
