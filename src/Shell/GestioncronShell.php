<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\CrontabComponent;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Core\Configure;

/**
 * Simple console wrapper around Psy\Shell.
 */
class GestioncronShell extends Shell
{
    
    public function addCron(){
        die('Obselète');
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('Crons');
        $crons = $this->Crons->find('all')
                    ->contain(['Evenements'])
                    ->where(['Crons.date_debut <' => Time::now(),'Crons.date_fin >' =>Time::now(), 'Crons.is_active'=>true]);
        foreach($crons as $cron){
             $this->crontab = new CrontabComponent(new ComponentRegistry());
             $cronText = "";
             switch ($cron->intervalle_id) {
                    case 1: // 5 mn
                        $cronText ="*/5 * * * *";
                        break;
                    case 2: // 10 mn
                        $cronText = "*/10 * * * *";
                        break;
                    case 3: // 30 mn
                        $cronText = "*/30 * * * *";
                        break;
                    case 4: // 1h
                        $cronText = "0 */1 * * *";
                        break;
            }

             if(!empty($cronText)){
                //$cronText = $cronText.' wget -O - http://event.selfizee.fr/cadre-data/uploadDataborneNoCsvWs/'.$cron->cadre_data->cd_name;
                $cronTextToEdit = $cronText.' cd ' .Configure::read('chemin_public_html').' && bin/cake photo import '.$cron->evenement_id.' '.intval($cron->is_cron_email)." ".intval($cron->is_cron_sms);
                $this->crontab->addJob($cronTextToEdit);
             }
             
        }
        
    }
    
    public function removeCron(){
        die('Obselète');
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('Crons');
        $crons = $this->Crons->find('all')
                    ->contain(['Evenements'])
                    /*->where(['Crons.date_fin <' =>Time::now()])
                    ->orWhere(['Crons.is_active'=>false]);*/
                    ->where(['OR' => [ ['Crons.date_fin <' =>Time::now()], ['Crons.is_active'=>false] ] ]);
                    //debug(Time::now());
        foreach($crons as $cron){
             $this->crontab = new CrontabComponent(new ComponentRegistry());
             $cronText = "";
             switch ($cron->intervalle_id) {
                    case 1: // 5 mn
                        $cronText ="*/5 * * * *";
                        break;
                    case 2: // 10 mn
                        $cronText = "*/10 * * * *";
                        break;
                    case 3: // 30 mn
                        $cronText = "*/30 * * * *";
                        break;
                    case 4: // 1h
                        $cronText = "0 */1 * * *";
                        break;
            }

             if(!empty($cronText)){
                //$cronText = $cronText.' wget -O - http://event.selfizee.fr/cadre-data/uploadDataborneNoCsvWs/'.$cron->cadre_data->cd_name;
                $cronTextToEdit = $cronText.' cd ' .Configure::read('chemin_public_html').' && bin/cake photo import '.intval($cron->evenement_id).' '.intval($cron->is_cron_email)." ".intval($cron->is_cron_sms);
                $this->crontab->removeJob($cronTextToEdit);
             }
             
        }
        
    }
    
    public function addCronFacebook(){
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('FacebookAutos');
        $facebookAutos = $this->FacebookAutos->find('all')
                    ->contain(['Evenements'])
                    ->where(['FacebookAutos.date_debut <' => Time::now(),'FacebookAutos.date_fin >' =>Time::now(), 'FacebookAutos.is_active'=>true]);
        foreach($facebookAutos as $facebookAuto){
             $this->crontab = new CrontabComponent(new ComponentRegistry());
             $cronText = "";
             switch ($facebookAuto->intervalle_id) {
                    case 1: // 5 mn
                        $cronText ="*/5 * * * *";
                        break;
                    case 2: // 10 mn
                        $cronText = "*/10 * * * *";
                        break;
                    case 3: // 30 mn
                        $cronText = "*/30 * * * *";
                        break;
                    case 4: // 1h
                        $cronText = "0 */1 * * *";
                        break;
            }

             if(!empty($cronText)){
                $cronTextToEdit = $cronText.' cd ' .Configure::read('chemin_public_html').' && bin/cake AutoPostFacebook postByIdFacebookAuto '.$facebookAuto->id;
                $this->crontab->addJob($cronTextToEdit);
             }
             
        }
        
    }
    
    public function removeCronFacebook(){
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('FacebookAutos');
        $facebookAutos = $this->FacebookAutos->find('all')
                    ->contain(['Evenements'])
                    ->where(['OR' => [ ['FacebookAutos.date_fin <' =>Time::now()], ['FacebookAutos.is_active'=>false] ] ]);
                    
        foreach($facebookAutos as $facebookAuto){
             $this->crontab = new CrontabComponent(new ComponentRegistry());
             $cronText = "";
             switch ($facebookAuto->intervalle_id) {
                    case 1: // 5 mn
                        $cronText ="*/5 * * * *";
                        break;
                    case 2: // 10 mn
                        $cronText = "*/10 * * * *";
                        break;
                    case 3: // 30 mn
                        $cronText = "*/30 * * * *";
                        break;
                    case 4: // 1h
                        $cronText = "0 */1 * * *";
                        break;
            }

             if(!empty($cronText)){
                $cronTextToEdit = $cronText.' cd ' .Configure::read('chemin_public_html').' && bin/cake AutoPostFacebook postByIdFacebookAuto '.$facebookAuto->id;
                $this->crontab->removeJob($cronTextToEdit);
             }
             
        }
        
    }
    
    public function addCronEvenemement(){
        die('Obselète');
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('Evenements');
        $evenements = $this->Evenements->find('all')
                    ->where(['Evenements.date_debut <' => Time::now(),'Evenements.date_fin >' =>Time::now()]);
        foreach($evenements as $evenement){
            $this->crontab = new CrontabComponent(new ComponentRegistry());
            $cronTextToEdit = '*/5 * * * * cd ' .Configure::read('chemin_public_html').' && bin/cake photo import '.$evenement->id.' 0 0';
            $this->crontab->addJob($cronTextToEdit);
        }
    }
    
     public function removeCronEvenemement(){
        die('Obselète');
        date_default_timezone_set('Europe/Paris');
        $this->loadModel('Evenements');
        $evenements = $this->Evenements->find('all')
                    ->where(['Evenements.date_fin <' => Time::now()]);
        foreach($evenements as $evenement){
            $this->crontab = new CrontabComponent(new ComponentRegistry());
            $cronTextToEdit = '*/5 * * * * cd ' .Configure::read('chemin_public_html').' && bin/cake photo import '.$evenement->id.' 0 0';
            $this->crontab->removeJob($cronTextToEdit);
        }
    }
    
    

}
