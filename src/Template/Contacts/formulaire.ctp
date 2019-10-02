<?= $this->Html->css('daterange/bootstrap-timepicker.min.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/daterangepicker.css', ['block' => true]) ?>
<?= $this->Html->script('daterange/moment.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/bootstrap-timepicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/daterangepicker.js', ['block' => true]); ?>
<?= $this->Html->script('Contacts/formulaire.js', ['block' => true]); ?>
<?= $this->Html->css('evenements/board.css', ['block' => true]) ?>

<?php
$titrePage = "Contacts de l'événement" ;
$this->start('breadcumb');


$this->Breadcrumbs->add(
    'Evénements',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
    $evenement->nom,
    ['controller' => 'Evenements', 'action' => 'edit', $evenement->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>
<div class="row">
    <div class="col-md-12">
        <?php if ($countAllContact){ ?>
            <div class="card card-new-selfizee">
                <div class="card-header border-bottom">
                            <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                            <?php echo $this->Html->link('Importer fichier csv',['controller' => 'Contacts', 'action' => 'importer', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action ' ]); ?>
                            <?php 
                            if($contacts->count() >= 1 ){ 
                                unset($options['listeIdPhoto']);
                                echo $this->Html->link(' Exporter les contacts',
                                                            ['controller' => 'Contacts', 'action' => 'exportCsv', $idEvenement,'?'=>$options],
                                                            ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action m-r-15' ]); 
                             } 
                             ?>
                            <?php echo $this->Html->link('Voir le fichier csv',['controller' => 'Contacts', 'action' => 'voirCsv', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'pull-right link link-selfizee-action m-r-15' ]); ?>

                            <?php 
                            if(!empty($contacts->toArray())){ 
                                echo  $this->Form->postLink('Supprimer tous les contacts',['action'=>'deleteAll', $evenement->id, 1],['escape'=>false,"class"=>"pull-right link link-selfizee-action p-r-0 m-r-15 ",'confirm'=>'Etes vous sûr de vouloir tout supprimer ?']); 
                            } 
                            ?>

                            <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="kl_titreTop">
                        <div class="kl_syntheseEvent pull-left">Synthèse événement :</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-2 kl_nopadding">
                            <a href="javascript:void(0)">
                                <div class="kl_oneStatCount text-center">
                                    <span class="kl_statNbrValue"><?= $this->Paginator->counter(['format' => __('{{count}}')]) ?></span> 
                                    <?php 
                                        $totalContacts = intval($this->Paginator->counter(['format' => __('{{count}}')])) ;
                                        echo $totalContacts > 1 ? "contacts" : "contact";
                                    ?> 
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 kl_nopadding">
                            <a href="javascript:void(0)">
                                <div class="kl_oneStatCount text-center">
                                    <span class="kl_statNbrValue">
                                        <?= $countContactEmail ?>
                                    </span> 
                                    <?= $countContactEmail > 1 ? "emails" : "email" ?>
                                </div>
                            </a>
                        </div>
                        

                        <div class="col-md-2 kl_nopadding">
                            <a href="javascript:void(0)">
                                <div class="kl_oneStatCount text-center">
                                    <span class="kl_statNbrValue"><?= $countContactTel ?></span> <?= $countContactTel > 1 ? "téléphones" : "téléphone" ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="kl_theFiltre">
                        <?php  
                            echo $this->Form->create(null, ['type' => 'get' ,'id'=>'id_filtreContact','role'=>'form']);   
                        ?>
                        <?php 

                        echo $this->Form->control('filtre',['label'=>'Activer le filtre','type'=>'checkbox','id'=>'id_filtreToActive', "value"=>'1','default' => $filtre,'hiddenField' => false]); ?>
                        <div class="kl_filtre_contact <?= empty($filtre) ? 'hide' :'' ?>"  id="id_blocFormFiltre">
                            <div class="row">
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('key',['value'=>$key, 'label'=>false, 'class'=>'form-control search','placeholder'=>'Rechercher...']); ?>
                                </div>            
                                <div class="col-md-3" id="id_datePickerMois">
                                    <div class="form-group">
                                        <input class="form-control input-daterange-datepicker" type="text" name="periode" value="<?= $periode ?>" placeholder="jj/mm/aaaa - jj/mm/aaaa"  />
                                    </div>
                                </div>
                                
                                <?php 
                                foreach($csvColonnePositions as $colonne){
                                ?>
                                <div class="col-md-3">
                                    <?php 
                                        //debug($is_optin_galerie); 
                                        $optinOptions = ['1' => 'Oui', '2' => 'Non'];
                                        if ($colonne->csv_colonne->nom_colonne_in_photo != null) {
                                            eval('$default = $'.$colonne->csv_colonne->nom_colonne_in_photo.';');
                                            echo $this->Form->select($colonne->csv_colonne->nom_colonne_in_photo, $optinOptions, ['default'=>$default,'empty' => $colonne->csv_colonne->nom,'class'=>'form-control']);
                                        }
                                    ?>
                                </div>
                                
                                <?php }?>
                               
                                <div class="col-md-3">
                                    <div class="row btn_filtre_contact">
                                        <div class="col-md-4 p-r-0 ">
                                            <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-selfizee-inverse noborber'] );?>
                                        </div>
                                        <div class="col-md-4 p-l-0 ">
                                            <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Réinitialiser', ['action' => 'formulaire', $evenement->id], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"btn btn-selfizee-inverse noborber", "escape"=>false]);   ?>         
                                        </div>
                                    </div>   
                                </div>     
                            </div>
                        </div>
                        <?php 
                            echo $this->Form->end(); 
                        ?>
                    </div>
                </div>
            </div>
            
            <div id="body_borne" class=" mt-3 " > <!-- mt-3 -->
                <div class="col-12  p-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="kl_deleteSelectContact hide" id="id_contactSelected">
                                 <?= $this->Form->postLink('<i class="mdi mdi-delete"></i> Supprimer les contacts séléctionnés',['action'=>'deleteSelected', $evenement->id,1],['escape'=>false,"class"=>"btn btn-danger ",'confirm'=>'Etes vous sûr de vouloir supprimer les contacts séléctionnés ?']); ?>
                                <input type="hidden" value="<?= $evenement->id ?>" id="id_evenement" />
                            </div>  
                            <div class="table-responsive" id="tete">
                            </div>
                            <div class="table-responsive">
                                <table class="table tableContact" id="id_tableContact" >
                                        <thead id="id_headeToFixed">
                                            <tr id="entete_table">
                                                <th scope="col"> <input type="checkbox" id="id_chekAll" /></th>
                                                <th scope="col"><?= $this->Paginator->sort('photo_id','Photo') ?></th>
                                                <th  scope="col"><?= $this->Paginator->sort('email','E-mail') ?></th>
                                                <th scope="col"><?= $this->Paginator->sort('telephone','Tel') ?></th>
                                                <th scope="col"><a href="<?= $this->Paginator->generateUrl(['customSort' => 'dateHeurePrisePhoto','customDirection'=>""]);?>">Date photo</a></th>
                                                
                                                
                                                <!--
                                                <?php if(in_array(1, $listeIdColonne)){?>
                                                    <th scope="col"><?= $this->Paginator->sort('Photos.is_postable_on_facebook',"Opt-in réseaux sociaux") ?></th>
                                                <?php } ?>
                                                
                                                <?php if(in_array(2, $listeIdColonne)){?>
                                                    <th scope="col"><?= $this->Paginator->sort('Photos.is_optin_galerie',"Opt-in galerie") ?></th>
                                                <?php } ?>
                                                
                                                <?php if(in_array(3, $listeIdColonne)){?>
                                                    <th scope="col"><?= $this->Paginator->sort('Photos.is_optin_email',"Opt-in E-mail") ?></th>
                                                    <th scope="col"><?= $this->Paginator->sort('Photos.is_optin_sms',"Opt-in Sms") ?></th>
                                                <?php }else{ ?>
                                                    <?php if(in_array(4, $listeIdColonne)){?>
                                                    <th scope="col"><?= $this->Paginator->sort('Photos.is_optin_email',"Opt-in E-mail") ?></th>
                                                    <?php } ?>
                                                    <?php if(in_array(5, $listeIdColonne)){?>
                                                    <th scope="col"><?= $this->Paginator->sort('Photos.is_optin_sms',"Opt-in Sms") ?></th>
                                                    <?php } ?>
                                                <?php } ?>
                                                -->
                                                <?php 
                                                //var_dump($countAllSurveyNotEmpty);
                                                //var_dump($listePositionChamp);
                                                foreach($countAllSurveyNotEmpty as $key =>  $countSurveyNotEmpty){
                                                    $num  = substr($key, -1);
                                                    if($countSurveyNotEmpty /*&& !in_array($num, $listePositionDefinie )*/) {
                                                    $champName = 'Champ '.$num;
                                                    if(isset($listePositionChamp[$num])){
                                                        $champName = $listePositionChamp[$num];
                                                    }
                                                  
                                                ?>
                                                            <th scope="col"><?= $this->Paginator->sort('photo.'.$key,$champName) ?></th>
                                                <?php
                                                                
                                                        
                                                    }
                                                }
                                                ?>
                                                
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                                            </tr>
                                        </thead>
                                
                                        <tbody id="id_bodyConctTable">
                                            <?php 
                                            if($contacts->count()){
                                                //debug($contacts);
                                            foreach ($contacts as $contact){ 
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="contact[]" value="<?= $contact->id ?>" class="kl_OneContact" />
                                                </td>
                                                <td class="kl_thePhoto">
                                                    <a class="kl_linkPhoto btn default btn-outline image-popup-vertical-fit" href="<?= $contact->photo->url_photo ?>">
                                                    <?php
                                                      echo $this->Html->image($contact->photo->url_thumb_bo,['width'=>75]);
                                                    ?>
                                                    </a>
                                                </td>
                                                <td  class="kl_theEmail">
                                                    <?= $this->Html->link(($contact->email),['controller'=>'Statistiques','action'=>'detailStatEmail', $evenement->id, $contact->id],['class'=>'kl_linkVersStatEmail']) ?>
                                                </td>
                                                <td class="kl_theTel"><?= h($contact->telephone) ?></td>
                                                <td class="kl_theDateprisePhoto"><?php if(!empty($contact->photo->date_prise_photo)) echo $contact->photo->date_prise_photo->format('d-m-y').$contact->photo->heure_prise_photo->format(' à H\hi'); ?></td>
                                               <!--
                                                
                                                <?php if(in_array(1, $listeIdColonne)){?>
                                                    <td><?= $contact->photo->is_postable_on_facebook ? "Oui" : "Non"; ?></td>
                                                <?php } ?>
                                                
                                                <?php if(in_array(2, $listeIdColonne)){?>
                                                    <td><?= $contact->photo->is_optin_galerie ? "Oui" : "Non"; ?></td>
                                                <?php } ?>
                                                
                                                <?php if(in_array(3, $listeIdColonne)){?>
                                                    <td><?= $contact->photo->is_optin_email ? "Oui" : "Non"; ?></td>
                                                    <td><?= $contact->photo->is_optin_sms ? "Oui" : "Non"; ?></td>
                                                <?php }else{ ?>
                                                    <?php if(in_array(4, $listeIdColonne)){?>
                                                    <td><?= $contact->photo->is_optin_email ? "Oui" : "Non"; ?></td>
                                                    <?php } ?>
                                                    <?php if(in_array(5, $listeIdColonne)){?>
                                                    <td><?= $contact->photo->is_optin_sms ? "Oui" : "Non"; ?></td>
                                                    <?php } ?>
                                                <?php } ?>
                                               -->
                                                                                
                                                  <?php 
                                                foreach($countAllSurveyNotEmpty as $key =>  $countSurveyNotEmpty){
                                                    $num  = substr($key, -1);
                                                    if($countSurveyNotEmpty /*&& !in_array($num, $listePositionDefinie)*/) {
                                                       
                                                ?>
                                                 
                                                            <td><?= $contact->photo->$key ?></td>
                                                <?php
                                                                
                                                        
                                                    }
                                                }
                                                ?>
                                                <td class="actions">
                                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete',$evenement->id, $contact->id, true], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                                                </td>
                                            </tr>
                                            <?php }}else{ ?>
                                                <tr>
                                                    <td colspan="12">
                                                        <p class="text-center">Aucun résultat</p>
                                                    </td>
                                                </tr>
                                           <?php } ?>
                                        </tbody>
                                        
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="text-right">
                                                        <ul class="pagination">
                                                            <?= $this->Paginator->first('<< ' . __('first')) ?>
                                                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                                            <?= $this->Paginator->numbers() ?>
                                                            <?= $this->Paginator->next(__('next') . ' >') ?>
                                                            <?= $this->Paginator->last(__('last') . ' >>') ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
            <!-- Column -->
            <div class="card card-new-selfizee">
                <div class="card-header border-bottom">
                    <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="">Aucun contact</div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

