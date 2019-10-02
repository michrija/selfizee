<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DownloadConfigurations Model
 *
 * @property \App\Model\Table\EvenementsTable|\Cake\ORM\Association\BelongsTo $Evenements
 *
 * @method \App\Model\Entity\DownloadConfiguration get($primaryKey, $options = [])
 * @method \App\Model\Entity\DownloadConfiguration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DownloadConfiguration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DownloadConfiguration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DownloadConfiguration|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DownloadConfiguration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DownloadConfiguration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DownloadConfiguration findOrCreate($search, callable $callback = null, $options = [])
 */
class DownloadConfigurationsTable extends Table
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

        $this->setTable('download_configurations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Evenements', [
            'foreignKey' => 'evenement_id'
        ]);

        $this->belongsTo('Clients', [
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
            ->boolean('is_oblig_ajout_infos_av_down')
            ->requirePresence('is_oblig_ajout_infos_av_down', 'create')
            ->notEmpty('is_oblig_ajout_infos_av_down');

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
