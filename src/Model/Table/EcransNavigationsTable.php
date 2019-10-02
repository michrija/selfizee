<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EcransNavigations Model
 *
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 * @property \App\Model\Table\PageConfigFondsTable|\Cake\ORM\Association\BelongsTo $PageConfigFonds
 * @property \App\Model\Table\PageConfigBoutonsTable|\Cake\ORM\Association\BelongsTo $PageConfigBoutons
 * @property \App\Model\Table\PageConfigPolicesTable|\Cake\ORM\Association\BelongsTo $PageConfigPolices
 *
 * @method \App\Model\Entity\EcransNavigation get($primaryKey, $options = [])
 * @method \App\Model\Entity\EcransNavigation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EcransNavigation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EcransNavigation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EcransNavigation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EcransNavigation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EcransNavigation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EcransNavigation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EcransNavigationsTable extends Table
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

        $this->setTable('ecrans_navigations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id'
        ]);
        $this->belongsTo('PageConfigFonds', [
            'foreignKey' => 'page_config_fond_id'
        ]);
        $this->belongsTo('PageConfigBoutons', [
            'foreignKey' => 'page_config_bouton_id'
        ]);
        $this->belongsTo('PageConfigPolices', [
            'foreignKey' => 'page_config_police_id'
        ]);
        $this->belongsTo('Catalogues', [
            'foreignKey' => 'catalogue_id'
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
            ->scalar('page_accueil_image_fond')
            ->maxLength('page_accueil_image_fond', 255)
            ->allowEmpty('page_accueil_image_fond');

        $validator
            ->scalar('page_accueil_couleur_fond')
            ->maxLength('page_accueil_couleur_fond', 255)
            ->allowEmpty('page_accueil_couleur_fond');

        $validator
            ->scalar('page_accueil_image_btn')
            ->maxLength('page_accueil_image_btn', 255)
            ->allowEmpty('page_accueil_image_btn');

        $validator
            ->scalar('page_prise_photos_image_fond')
            ->maxLength('page_prise_photos_image_fond', 255)
            ->allowEmpty('page_prise_photos_image_fond');

        $validator
            ->scalar('page_prise_photos_couleur_fond')
            ->maxLength('page_prise_photos_couleur_fond', 255)
            ->allowEmpty('page_prise_photos_couleur_fond');

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
        $rules->add($rules->existsIn(['configuration_borne_id'], 'ConfigurationBornes'));
        $rules->add($rules->existsIn(['page_config_fond_id'], 'PageConfigFonds'));
        $rules->add($rules->existsIn(['page_config_bouton_id'], 'PageConfigBoutons'));
        $rules->add($rules->existsIn(['page_config_police_id'], 'PageConfigPolices'));

        return $rules;
    }
}
