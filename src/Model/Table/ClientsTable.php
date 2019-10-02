<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Expression\QueryExpression;

/**
 * Clients Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\HasMany $Evenements
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientsTable extends Table
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

        $this->setTable('clients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TypeClients', [
            'foreignKey' => 'client_type_id'
        ]);
        $this->hasMany('Evenements', [
            'foreignKey' => 'client_id'
        ]);
        
        $this->hasOne('Users', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER'
        ]);
     
        
        $this->hasMany('ClientContacts', [
            'foreignKey' => 'client_id'
        ]);
        $this->hasOne('ContactPrincipales', [
            'foreignKey' => 'contact_client_id'
        ]);
        $this->hasMany('Credits', [
            'foreignKey' => 'client_id'
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
            ->requirePresence('nom', 'create')
            ->notEmpty('nom');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 255)
            ->allowEmpty('adresse');


        $validator
            ->allowEmpty('url_bo')
            ->add('url_bo', 'valid-url', ['rule' => 'url', false]);


        $validator
            ->allowEmpty('url_site_web')
            ->add('url_site_web', 'valid-url', ['rule' => 'url']);

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
        //$rules->add($rules->isUnique(['url_bo']));
        return $rules;
    }
    
     public function findFiltre(Query $query, array $options) {

        $search = $options['key'];

        if(!empty($search)){
            $query->where(['nom LIKE' => '%'.$search.'%']);
            $query->contain('Users', function ($q) use ($search) {
                return $q->where(['Users.username LIKE' => '%'.$search.'%']);
            });

            /*$query->where(function (QueryExpression $exp) use($search) {
               
                $orConditions = $exp->or_(function ($or) use($search) {
                    return $or->like('Clients.nom', $search)
                        ->like('Clients.prenom', $search)
                        ->like('Users.username', $search);
                });
               
                return $exp
                    ->add($orConditions);
            });*/
        }



        return $query;
    }
}
