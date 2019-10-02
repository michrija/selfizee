<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OptionBornes Model
 *
 * @method \App\Model\Entity\OptionBorne get($primaryKey, $options = [])
 * @method \App\Model\Entity\OptionBorne newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OptionBorne[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OptionBorne|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OptionBorne|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OptionBorne patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OptionBorne[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OptionBorne findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OptionBornesTable extends Table
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

        $this->setTable('option_bornes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('chemin_dossier_assets')
            ->allowEmpty('chemin_dossier_assets');

        $validator
            ->scalar('chemin_dossier_events')
            ->allowEmpty('chemin_dossier_events');

        $validator
            ->scalar('fichier_setting_base')
            ->allowEmpty('fichier_setting_base');

        $validator
            ->scalar('ftp_server')
            ->maxLength('ftp_server', 250)
            ->allowEmpty('ftp_server');

        $validator
            ->scalar('ftp_username')
            ->maxLength('ftp_username', 250)
            ->allowEmpty('ftp_username');

        $validator
            ->scalar('ftp_password')
            ->maxLength('ftp_password', 250)
            ->allowEmpty('ftp_password');

        $validator
            ->scalar('ftp_port')
            ->maxLength('ftp_port', 250)
            ->allowEmpty('ftp_port');

        return $validator;
    }
}
