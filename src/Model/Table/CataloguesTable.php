<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Catalogues Model
 *
 * @property \App\Model\Table\ImageFondsTable|\Cake\ORM\Association\HasMany $ImageFonds
 *
 * @method \App\Model\Entity\Catalogue get($primaryKey, $options = [])
 * @method \App\Model\Entity\Catalogue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Catalogue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Catalogue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Catalogue|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Catalogue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Catalogue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Catalogue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CataloguesTable extends Table
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

        $this->setTable('catalogues');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ImageFonds', [
            'foreignKey' => 'catalogue_id'
        ]);

        $this->hasMany('ImageFonds', [
            'foreignKey' => 'catalogue_id'
        ]);
        
        $this->hasOne('EcranAccueils', [
            'className' => 'ImageFonds',
            'foreignKey' => 'catalogue_id',
            'conditions' => ['EcranAccueils.type'=>'accueil']
        ]);

        $this->hasOne('EcranPrisePhotos', [
            'className' => 'ImageFonds',
            'foreignKey' => 'catalogue_id',
            'conditions' => ['EcranPrisePhotos.type'=>'prise_photo']
        ]);

        $this->hasOne('Cadres', [
            'className' => 'ImageFonds',
            'foreignKey' => 'catalogue_id',
            'conditions' => ['Cadres.type'=>'cadre']
        ]);
        
        $this->hasOne('EcranFiltres', [
            'className' => 'ImageFonds',
            'foreignKey' => 'catalogue_id',
            'conditions' => ['EcranFiltres.type'=>'filtre']
        ]);

        $this->hasOne('EcranRemerciements', [
            'className' => 'ImageFonds',
            'foreignKey' => 'catalogue_id',
            'conditions' => ['EcranRemerciements.type'=>'remerciement']
        ]);

        $this->hasOne('EcranVisualisationPhotos', [
            'className' => 'ImageFonds',
            'foreignKey' => 'catalogue_id',
            'conditions' => ['EcranVisualisationPhotos.type'=>'visualisation']
        ]);
        $this->hasOne('EcranChoixFondVerts', [
            'className' => 'ImageFonds',
            'foreignKey' => 'catalogue_id',
            'conditions' => ['EcranChoixFondVerts.type'=>'choix_fv']
        ]);

        $this->belongsTo('Formats', [
            'foreignKey' => 'format_id'
        ]);

        /*$this->belongsTo('Themes', [
            'foreignKey' => 'theme_id'
        ]);*/

        $this->belongsToMany('Themes', [
            'className' => 'Themes',
            'through' => 'CatalogueThemes',
            'joinTable' => 'catalogue_themes',
            'foreignKey' => 'catalogue_id',
            'targetForeignKey' => 'theme_id'
        ]);

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
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->allowEmpty('nom');

        return $validator;
    }
}
