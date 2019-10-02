<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersCustoms Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UsersCustom get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersCustom newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersCustom[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersCustom|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersCustom|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersCustom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersCustom[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersCustom findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersCustomsTable extends Table
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

        $this->setTable('users_customs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->scalar('ps_publicite')
            ->allowEmpty('ps_publicite');

        $validator
            ->scalar('ps_bandeau_par_defaut')
            ->maxLength('ps_bandeau_par_defaut', 255)
            ->allowEmpty('ps_bandeau_par_defaut');

        $validator
            ->scalar('ps_couleur_de_fond')
            ->maxLength('ps_couleur_de_fond', 255)
            ->allowEmpty('ps_couleur_de_fond');

        $validator
            ->scalar('gs_nom')
            ->maxLength('gs_nom', 255)
            ->allowEmpty('gs_nom');

        $validator
            ->scalar('gs_slug')
            ->maxLength('gs_slug', 255)
            ->allowEmpty('gs_slug');

        $validator
            ->scalar('gs_is_public')
            ->maxLength('gs_is_public', 255)
            ->allowEmpty('gs_is_public');

        $validator
            ->scalar('gs_titre')
            ->maxLength('gs_titre', 255)
            ->allowEmpty('gs_titre');

        $validator
            ->scalar('gs_sous_titre')
            ->maxLength('gs_sous_titre', 255)
            ->allowEmpty('gs_sous_titre');

        $validator
            ->scalar('gs_couleur')
            ->maxLength('gs_couleur', 255)
            ->allowEmpty('gs_couleur');

        $validator
            ->scalar('gs_img_banniere')
            ->maxLength('gs_img_banniere', 255)
            ->allowEmpty('gs_img_banniere');

        $validator
            ->boolean('gs_is_livredor_active')
            ->requirePresence('gs_is_livredor_active', 'create')
            ->notEmpty('gs_is_livredor_active');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
