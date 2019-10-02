<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReponsesPageSouvenirs Model
 *
 * @property \App\Model\Table\ChampOptionsTable|\Cake\ORM\Association\BelongsTo $ChampOptions
 * @property \App\Model\Table\ChampsTable|\Cake\ORM\Association\BelongsTo $Champs
 * @property \App\Model\Table\PhotosTable|\Cake\ORM\Association\BelongsTo $Photos
 * @property |\Cake\ORM\Association\BelongsTo $PageSouvenirs
 *
 * @method \App\Model\Entity\ReponsesPageSouvenir get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReponsesPageSouvenir newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReponsesPageSouvenir[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReponsesPageSouvenir|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReponsesPageSouvenir|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReponsesPageSouvenir patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReponsesPageSouvenir[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReponsesPageSouvenir findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReponsesPageSouvenirsTable extends Table
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

        $this->setTable('reponses_page_souvenirs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ChampOptions', [
            'foreignKey' => 'champ_option_id'
        ]);
        $this->belongsTo('Champs', [
            'foreignKey' => 'champ_id'
        ]);
        $this->belongsTo('Photos', [
            'foreignKey' => 'photo_id'
        ]);
        $this->belongsTo('PageSouvenirs', [
            'foreignKey' => 'page_souvenir_id'
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
            ->scalar('value_text')
            ->maxLength('value_text', 255)
            ->allowEmpty('value_text');

        $validator
            ->scalar('queque')
            ->maxLength('queque', 255)
            ->allowEmpty('queque');

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
        $rules->add($rules->existsIn(['champ_option_id'], 'ChampOptions'));
        $rules->add($rules->existsIn(['champ_id'], 'Champs'));
        $rules->add($rules->existsIn(['photo_id'], 'Photos'));
        $rules->add($rules->existsIn(['page_souvenir_id'], 'PageSouvenirs'));

        return $rules;
    }
}
