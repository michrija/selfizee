<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Conditions Controller
 *
 * @property \App\Model\Table\ConditionsTable $Conditions
 *
 * @method \App\Model\Entity\Filtre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConditionsController extends AppController
{

    
    public function initialize(){
        $this->viewBuilder()->setLayout('conditions');
    }

    public function cookiees(){
        
    }
}
