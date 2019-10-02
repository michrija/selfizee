<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.3.4
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;
use Cake\Http\Response;

class SmsTarifsController extends AppController
{
   public function index()
   {
      $this->viewBuilder()->setLayout('sans_menu');
    $sms=$this->SmsTarifs->find("all");
    $res=$sms ->toArray();
    $this->set(compact('res'));
   }

    public function add()
    {
          $this->viewBuilder()->setLayout('sans_menu');
      $smsEntity=$this->SmsTarifs->newEntity();
      if($this->request ->is('post')){
         $data=$this->request ->data;
         $smsEntity=$this->SmsTarifs ->patchEntity($smsEntity,$data);
         $smsEntity=$this->SmsTarifs ->save($smsEntity);
         $this->redirect( ['controller' => 'SmsTarifs', 'action' => 'index']);
      }
       $this->set(compact('smsEntity'));
    }

      public function editer($id)
    {
         $this->viewBuilder()->setLayout('sans_menu');
         $smsEntity=$this->SmsTarifs->get($id);
          if($this->request ->is('put')){
             $data=$this->request ->data;
             $smsEntity=$this->SmsTarifs ->patchEntity($smsEntity,$data);
             $smsEntity=$this->SmsTarifs ->save($smsEntity);
             $this->redirect( ['controller' => 'SmsTarifs', 'action' => 'index']);
          }
       $this->set(compact('smsEntity'));
    }

       public function delete($id)
    {

        $id=$this->request->query('id');
        $sms=$this->SmsTarifs->findById($id)->first();
        
        $this->SmsTarifs->deleteAll(['id' => $id]);
        return new Response(['success'=>true]);
         
    }

}
