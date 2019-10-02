
<?php
namespace App\Controller;

use App\Controller\AppController;

class CssCustomsController extends AppController
{

	public function initialize(array $config = [])
	{
	    parent::initialize($config);
	    $this->Auth->allow();
	}

	public function login($idClient){
		$this->loadModel('Clients');
		$client = $this->Clients->get($idClient);
		//content-type: text/css
		$this->response->type('text/css');
		$this->viewBuilder()->setLayout('ajax');
		$this->set(compact('client'));
	}

	public function interne($idClient){
		$this->loadModel('Clients');
		$client = $this->Clients->get($idClient);
		//content-type: text/css
		$this->response->type('text/css');
		$this->viewBuilder()->setLayout('ajax');
		$this->set(compact('client'));
	}

	public function galerielogin($idClient){
	    $this->loadModel('Clients');
	    $client = $this->Clients->get($idClient);
	    $this->response->type('text/css');
	    $this->viewBuilder()->setLayout('ajax');
	    $this->set(compact('client'));
	}
}