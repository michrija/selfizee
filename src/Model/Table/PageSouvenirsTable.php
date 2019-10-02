<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PageSouvenirs Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\PageSouvenir get($primaryKey, $options = [])
 * @method \App\Model\Entity\PageSouvenir newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PageSouvenir[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PageSouvenir|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageSouvenir|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PageSouvenir patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PageSouvenir[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PageSouvenir findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PageSouvenirsTable extends Table
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

        $this->setTable('page_souvenirs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Champs', [
            'foreignKey' => 'page_souvenir_id',
            'saveStrategy' => 'replace'
        ]);

        $this->hasOne('RsConfigurations', [
            'foreignKey' => 'page_souvenir_id',
            'saveStrategy' => 'replace'
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
            ->scalar('couleur_fond_entete')
            ->maxLength('couleur_fond_entete', 45)
            ->allowEmpty('couleur_fond_entete');

        $validator
            ->scalar('couleur_fond')
            ->maxLength('couleur_fond', 45)
            ->allowEmpty('couleur_fond');
            
            
        $validator
            ->scalar('couleur_download_link')
            ->maxLength('couleur_download_link', 45)
            ->allowEmpty('couleur_download_link');

        $validator
            ->scalar('img_banniere')
            ->maxLength('img_banniere', 45)
            ->allowEmpty('img_banniere');

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
        $rules->add($rules->existsIn(['evenement_id'], 'Evenements'));

        return $rules;
    }
}
