<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InfosDownloadsGalerieSouvenirs Model
 *
 * @property \App\Model\Table\GaleriesTable|\Cake\ORM\Association\BelongsTo $Galeries
 *
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir get($primaryKey, $options = [])
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InfosDownloadsGalerieSouvenir findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InfosDownloadsGalerieSouvenirsTable extends Table
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

        $this->setTable('infos_downloads_galerie_souvenirs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Galeries', [
            'foreignKey' => 'galerie_id'
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

        $validator
            ->scalar('prenom')
            ->maxLength('prenom', 255)
            ->allowEmpty('prenom');

        $validator
            ->email('email')
            ->allowEmpty('email');

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
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['galerie_id'], 'Galeries'));

        return $rules;
    }
}
