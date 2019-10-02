<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Collection\Collection;


class CheckEmailShell extends Shell
{
	//==== Check contact email non envoyé
    public function checkEmailNotSent($idEvenement = null)
    {
        $this->loadModel('Evenements');
        $this->loadModel('Photos');
        $this->loadModel('Contacts');

        $emailNotDelivry = "null";
        //debug($evenement);
        if(!empty($idEvenement)){
            $evenement = $this->Evenements->get($idEvenement,[
                                            'contain' => ['Photos','Galeries']
                                        ]);

            if(!empty($evenement->photos)){
                $collection = new Collection($evenement->photos);
                $id = $collection->extract('id');
                $idPhotos = $id->toList();
                
                $listContactEmail = $this->Contacts->find('list',['valueField' => 'id'])
                                                            ->where(['photo_id IN' => $idPhotos,'email IS NOT' => 'NULL', 'email <>'=>''])
                                                            ->toArray();

                $emailNotDelivry = $this->Contacts->find('list', ['valueField'=>'email'])
                                        ->where(['contact_id IN' => $listContactEmail,
                                        'is_email_checked IS' => NULL 
                                        //'is_email_checked IS NOT' => NULL, 'email_propose IS NOT' => NULL, 'nom_de_domaine_id IS NOT' => NULL //====> Ici recheck email_propose 
                                        ]) 
                                        ->notMatching('Envois.EnvoiEmailStatDelivres')->toArray();
            }
        } else {
            $emailNotDelivry = $this->Contacts->find('list', ['valueField'=>'email'])
                                    ->where([
                                    'is_email_checked IS' => NULL, 
                                    //'is_email_checked IS NOT' => NULL, 'email_propose IS NOT' => NULL//, 'nom_de_domaine_id IS NOT' => NULL //====> Ici recheck email_propose
                                    ]) //'email_propose IS' => NULL
                                    ->notMatching('Envois.EnvoiEmailStatDelivres')
                                    ->limit('250')
                                    ->toArray();            
        };


        //debug(count($emailNotDelivry));die;     
        if(!empty($emailNotDelivry)){
            $i = 1;
            foreach ($emailNotDelivry as $key => $email) {
                $propositionEmail = $this->checkEmail($email);
                $contact = $this->Contacts->get($key);
                $contact->is_email_checked = true;
                $this->out("Cle ==> ".$i);
                if(!empty($propositionEmail)){                
                    $contact->email_propose = $propositionEmail;
                    if($propositionEmail != "ndd_hors_list") {     

                        $this->loadModel('NomDeDomaines');
                        $nomDeDomaine = $this->NomDeDomaines->newEntity();                    
                        $dataNdd = [];
                        $ndd_propose = $this->after("@", $propositionEmail);
                        $dataNdd ['nom_de_domaine'] = $ndd_propose;
                        $dataNdd ['is_propose'] = true;
                        //debug($ndd_propose);
                        $ndd_propose_find = $this->NomDeDomaines->find('all')->where(['nom_de_domaine'=>$ndd_propose])->first();
                        
                        if(!empty($ndd_propose_find)) {
                            $nomDeDomaine = $ndd_propose_find;//$this->out("Exist ==> ".$nomDeDomaine->id);
                        } else { 
                            $nomDeDomaine = $this->NomDeDomaines->patchEntity($nomDeDomaine, $dataNdd );
                            $this->NomDeDomaines->save($nomDeDomaine);//$this->out("New ==> ".$nomDeDomaine->id);
                        }
                        $this->out($nomDeDomaine->id);
                        $contact->nom_de_domaine_id = $nomDeDomaine->id;
                    } else {
                        $contact->nom_de_domaine_id = NULL;
                    }
                }

                if($this->Contacts->save($contact)){
                        $this->out( $key.": ".$email." ==> Checked");
                        if($contact->email_propose) $this->out( $key.". Email : ".$email."  ====> Proposition : ".$propositionEmail);
                }
                $i = $i + 1;
            }
            //die;
        }
        //$this->out($emailNotDelivry);die;
    }

    
    //================ Check error frappe email
    public function checkEmail($email)
    {
        $nom_de_domaine = $this->after("@", $email);
        $user_email = $this->before("@", $email);
        $adresse = $this->before(".", $nom_de_domaine);
        $extension = $this->after(".", $nom_de_domaine);
        //debug($adresse);die;

        $adresse_array = str_split($adresse);
        $nom_de_domaine_array = str_split($nom_de_domaine);
        //debug($nom_de_domaine); debug($adresse);die;
        

        $this->loadModel('NomDeDomaines');
        $list_nom_de_domaines = $this->NomDeDomaines->find('list',['valueField'=>'nom_de_domaine'])->where(['is_propose IS'=>NULL])->toArray();
        //debug($list_nom_de_domaines);die;

        $gmail = "gmail";
        $gmail = str_split($gmail);
        $proposition = "";
        
        if(!in_array($nom_de_domaine, $list_nom_de_domaines)) {
            foreach ($list_nom_de_domaines as $key => $ndd) {
                $ndd_ext = $this->after(".", $ndd);
                //debug($ndd);
                //if(!in_array($ndd_ext, $list_extensions)) $list_extensions [] = $ndd_ext;
                $ndd = $this->before(".", $ndd);
                $ndd = str_split($ndd);
                //debug(count($ndd));
                if((count($adresse_array) >= 2)) {
                    if ( ($adresse_array[0] == $ndd[0]) && ($adresse_array[1] == $ndd[1]) ) {
                            $proposition = implode('',$ndd);
                            break;
                    } else {
                        $proposition = "ndd_hors_list";
                    }
                }   
            }
            //debug($adresse_array[0]." == ".$ndd[0]."  /  ".$adresse_array[1]." == ".$ndd[1]." ===>  ".$proposition);die;
        }


        if(!empty($proposition) && ($proposition != "ndd_hors_list")){
            $list_extensions = ['fr', 'com', 'net', 'paris', 'eu'];
            $extension_array = str_split($extension);
            if(!in_array($extension, $list_extensions)) {
                foreach ($list_extensions as $key => $ext) {
                    # code...
                    $ext = str_split($ext);
                    if($extension_array[0] == $ext[0]){
                        $extension = implode('',$ext);                     
                    }
                }
            }

            $proposition = $user_email."@".$proposition.".".$extension;
        }

        //debug($proposition);die;
        return $proposition;
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


}