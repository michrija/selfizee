<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Filesystem\Folder;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\SmsenvoiComponent;
use App\Controller\Component\SendComponent; 
use Cake\Core\Configure;

class SmsShell extends Shell
{
    
    public function getStat(){
        $this->loadModel('Envois');
        $envois = $this->Envois->find()
                            ->contain(['Contacts'])
                            ->where([
                                    'Envois.envoi_type' => 'sms',
                                    'Envois.message_id_in_smsenvoi <>'=>'',
                                    'Envois.message_id_in_smsenvoi IS NOT'=>NULL
                            ])
                            ->notMatching('SmsStatistiques');
        $this->SmsEnvoi = new SmsenvoiComponent(new ComponentRegistry());
        
        foreach($envois as $envoi){
            $result = $this->SmsEnvoi->checkDelivery($envoi->message_id_in_smsenvoi);
            if(!empty($result)){
                $datas = get_object_vars($result);
                foreach ($datas as $data) {
                        $smsStat['envoi_id'] = $envoi->id;
                        $smsStat['ar'] = $data->ar;
                        $smsStat['errormsg']  = $data->errorcode;
                        $smsStat['statut']  = $data->arcode;
                        $smsStatistique = $this->Envois->SmsStatistiques->newEntity($smsStat);
                        /*$smsStatFind = $this->Envois->SmsStatistiques->find()
                                                                ->where(['envoi_id' => $envoi->id])
                                                                ->first();
                        if(!empty($smsStatFind)){
                            $smsStatistique = $smsStatFind;
                        }*/
                        if($this->Envois->SmsStatistiques->save($smsStatistique)){
                            $this->out('Sms stat save for '.$envoi->contact_id);
                        }else{
                            $this->out('Sms errreur '.$envoi->contact_id);
                        }
                        
                }
            }
        }
        
    }
}