<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;

/**
 * Lots Controller
 *
 * @property \App\Model\Table\LotsTable $Lots
 *
 * @method \App\Model\Entity\Lot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CsvlotController extends AppController
{

    public $helpers = ['Cewi/Excel.Excel'];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler', [
            'viewClassMap' => ['xlsx' => 'Cewi/Excel.Excel']
        ]);
    }


    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        $typeprofils = $user['typeprofils'];
        if (in_array('admin', $typeprofils)) {
            return true;
        }
        return parent::isAuthorized($user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function import()
    {
        $this->viewBuilder()->setLayout('sans_menu');

        
    }
}
