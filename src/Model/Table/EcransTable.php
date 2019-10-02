<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ecrans Model
 *
 * @property \App\Model\Table\ConfigurationBornesTable|\Cake\ORM\Association\BelongsTo $ConfigurationBornes
 *
 * @method \App\Model\Entity\Ecran get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ecran newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ecran[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ecran|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ecran|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ecran patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ecran[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ecran findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EcransTable extends Table
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

        $this->setTable('ecrans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ConfigurationBornes', [
            'foreignKey' => 'configuration_borne_id',
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

        $validator
            ->scalar('page_accueil')
            ->maxLength('page_accueil', 250)
            ->allowEmpty('page_accueil');

        $validator
            ->scalar('btn_page_accueil')
            ->maxLength('btn_page_accueil', 250)
            ->allowEmpty('btn_page_accueil');

        $validator
            ->scalar('page_prise_photo')
            ->maxLength('page_prise_photo', 250)
            ->allowEmpty('page_prise_photo');

        $validator
            ->scalar('page_prise_photo_visualisation')
            ->maxLength('page_prise_photo_visualisation', 250)
            ->allowEmpty('page_prise_photo_visualisation');

        $validator
            ->scalar('page_choix_filtre')
            ->maxLength('page_choix_filtre', 250)
            ->allowEmpty('page_choix_filtre');

        $validator
            ->scalar('page_remerciement')
            ->maxLength('page_remerciement', 250)
            ->allowEmpty('page_remerciement');

        $validator
            ->scalar('page_choix_fond_vert')
            ->maxLength('page_choix_fond_vert', 250)
            ->allowEmpty('page_choix_fond_vert');

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

        return $rules;
    }
}
