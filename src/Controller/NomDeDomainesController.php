<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NomDeDomaines Controller
 *
 * @property \App\Model\Table\NomDeDomainesTable $NomDeDomaines
 *
 * @method \App\Model\Entity\NomDeDomaine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NomDeDomainesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($idEvenement = null)
    {
        $this->paginate = [
            'conditions' =>['NomDeDomaines.is_propose'=> NULL]
        ];
       
        $nomDeDomaines = $this->paginate($this->NomDeDomaines);

        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement);

        $this->set(compact('nomDeDomaines', 'evenement', 'idEvenement'));
    }

    public function liste($idEvenement = null)
    {
        $this->paginate = [
            'conditions' =>['NomDeDomaines.is_propose IS'=> NULL]
        ];
        $nomDeDomaines = $this->paginate($this->NomDeDomaines);

        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement);


        //debug($contact_have_error_email);die;

        $this->set(compact('nomDeDomaines', 'evenement', 'idEvenement'));
        $this->set('isConfiguration',true);
    }

    public function erreuremail($idEvenement = null)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $evenement = $this->Evenements->get($idEvenement);

        $listeIdPhoto = $this->Photos->find('list', ['valueField'=> 'id'])->where(['evenement_id IN' =>$idEvenement, 'is_in_corbeille'=>false, 'deleted'=>false])->toArray();
        //debug($listeIdPhoto);die;

        $contacts_have_error_email = $this->Photos->Contacts->find('all', ['contain'=>['NddProposes']])
                              ->where(['Contacts.photo_id IN' => $listeIdPhoto,
                                        'email_propose !=' => "",
                                        'nom_de_domaine_id IS NOT' => NULL])
                              ->toArray();

        //debug($contacts_have_error_email);die;

        $this->set(compact('evenement', 'idEvenement', 'contacts_have_error_email'));
        $this->set('isConfiguration',true);
        //$this->render('index');
    }

    public function correction($idContact = null, $idEvenement = null)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Contacts');
        $contact = $this->Contacts->get($idContact);
        $evenement = $this->Evenements->get($idEvenement);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $ndd = $this->NomDeDomaines->get($data['nom_de_domaine_id']);
            $new_email_propose = $this->before("@", $data['contact_email'])."@".$ndd->nom_de_domaine;
            //debug($data['contact_email']);die;
            $contact->nom_de_domaine_id = intval($data['nom_de_domaine_id']);
            $contact->email_propose = $new_email_propose;
            //debug($contact);die;
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'erreuremail', $idEvenement]);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }

        $bef = $this->before("@",$contact->email);
        $ndds = $this->NomDeDomaines->find('list',['valueField'=> function ($e) use($bef) {return $bef.'@'. $e->nom_de_domaine;}])->where(['is_propose IS'=>NULL]);
        //debug($ndds->toArray());die;

        $this->set(compact('email_propose', 'evenement', 'contact', 'idEvenement', 'ndds'));
        $this->set('isConfiguration',true);
    }

    public function after($char, $inthat)
    {
        if (!is_bool(strpos($inthat, $char)))
        return substr($inthat, strpos($inthat,$char)+strlen($char));
    }

    public function before($char, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $char));
    }


    /**
     * View method
     *
     * @param string|null $id Nom De Domaine id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nomDeDomaine = $this->NomDeDomaines->get($id, [
            'contain' => []
        ]);

        $this->set('nomDeDomaine', $nomDeDomaine);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEvenement = null)
    {
        $nomDeDomaine = $this->NomDeDomaines->newEntity();
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement);

        if ($this->request->is('post')) {
            $nomDeDomaine = $this->NomDeDomaines->patchEntity($nomDeDomaine, $this->request->getData());
            if ($this->NomDeDomaines->save($nomDeDomaine)) {
                $this->Flash->success(__('The nom de domaine has been saved.'));

                return $this->redirect(['action' => 'liste', $idEvenement]);
            }
            $this->Flash->error(__('The nom de domaine could not be saved. Please, try again.'));
        }

        $this->set(compact('nomDeDomaine', 'evenement', 'idEvenement'));
        $this->set('isConfiguration',true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Nom De Domaine id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $idEvenement = null)
    {
        $nomDeDomaine = $this->NomDeDomaines->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Evenements');
        $evenement = $this->Evenements->get($idEvenement);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $nomDeDomaine = $this->NomDeDomaines->patchEntity($nomDeDomaine, $this->request->getData());
            if ($this->NomDeDomaines->save($nomDeDomaine)) {
                $this->Flash->success(__('The nom de domaine has been saved.'));

                return $this->redirect(['action' => 'liste', $idEvenement]);
            }
            $this->Flash->error(__('The nom de domaine could not be saved. Please, try again.'));
        }
        $this->set(compact('nomDeDomaine'));
        $this->set(compact('email_propose', 'evenement', 'idEvenement'));
        $this->set('isConfiguration',true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Nom De Domaine id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nomDeDomaine = $this->NomDeDomaines->get($id);
        if ($this->NomDeDomaines->delete($nomDeDomaine)) {
            $this->Flash->success(__('The nom de domaine has been deleted.'));
        } else {
            $this->Flash->error(__('The nom de domaine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
