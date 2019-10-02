<?= $this->Html->css('daterange/bootstrap-timepicker.min.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/daterangepicker.css', ['block' => true]) ?>
<?= $this->Html->script('daterange/moment.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/bootstrap-timepicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/daterangepicker.js', ['block' => true]); ?>
<?= $this->Html->script('Contacts/formulaire.js', ['block' => true]); ?>
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

<?php
$this->start('actionTitle');
?>
    <div class="pull-right">
        <?php //echo $this->Html->link('Importer fichier csv',['controller' => 'Contacts', 'action' => 'importer', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_bntLinkSimple' ]); ?>
        <?php 
        if($contacts->count() >= 1 ){ 
			if($idEvenement== 2403){
				//mgen-annecy-export.csv
				echo '<a href="https://manager.selfizee.fr/mgen-annecy-export.csv" aria-expanded="false" class="kl_bntLinkSimple"> Exporter les contacts</a>';
			}else{
				unset($options['listeIdPhoto']);
				echo $this->Html->link(' Exporter les contacts',
											['controller' => 'Contacts', 'action' => 'exportCsv', $idEvenement,'?'=>$options],
                                        ['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_bntLinkSimple' ]); 
			}
		} 
		 
         ?>
        <?php //echo $this->Html->link('Voir le fichier csv',['controller' => 'Contacts', 'action' => 'voirCsv', $idEvenement],['escapeTitle'=>false,'aria-expanded'=>'false','class'=>'kl_bntLinkSimple' ]); ?>
    </div>
 <?php $this->end(); ?>
 
    <div class="pull-right mt-3">
        <?php if(!empty($contacts->toArray())){ ?>
            <div class="pull-right">
                <?php //$this->Form->postLink('Supprimer tous les contacts',['action'=>'deleteAll', $evenement->id, 1],['escape'=>false,"class"=>"kl_bntLinkSimple ",'confirm'=>'Etes vous sûr de vouloir tout supprimer ?']); ?>
            </div>
        <?php } ?>
    </div>
     <div class="clearfix"></div>





<div class="clearfix"></div>
<?php if($countAllContact ){ ?>
<div class="kl_countEmail row mt-4">
        <div class="col-md-4">
            <div class="kl_totalNbr"><?= $this->Paginator->counter(['format' => __('{{count}}')]) ?></div>
            <div class="kl_titreBloc">
            <?php 
            $totalContacts = intval($this->Paginator->counter(['format' => __('{{count}}')])) ;
            echo $totalContacts > 1 ? "contacts" : "contact";
            ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kl_totalNbr"><?= $countContactEmail ?></div>
            <div class="kl_titreBloc"><?= $countContactEmail > 1 ? "emails" : "email" ?></div>
        </div>
        <div class="col-md-4">
            <div class="kl_totalNbr"><?= $countContactTel ?></div>
            <div class="kl_titreBloc"><?= $countContactTel > 1 ? "téléphones" : "téléphone" ?> </div>
        </div>
        
</div>

<div id="body_borne" class="row  mt-3 " > <!-- mt-3 -->
    
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
									<!-- Nom	Prénom	Date naissance	E-mail	Tel	Opt-in E-mail	Optin commercial	Date photo -->
                                    <th scope="col">Nom</th>
									<th scope="col">Prénom</th>
									<th scope="col">Date naissance</th>
									<th scope="col">E-mail</th>
									<th scope="col">Tel</th>
									<th scope="col">Opt-in E-mail</th>
									<th scope="col">Opt-in commercial</th>
									<th scope="col">Date photo</th>
								</tr>
                            </thead>
                    
                            <tbody id="id_bodyConctTable">
                                <?php 
                                if($contacts->count()){
                                    //debug($contacts);
                                foreach ($contacts as $contact){ 
                                ?>
                                <tr>
                                    <td><?= $contact->photo->survey1?></td>
									<td><?= $contact->photo->survey2?></td>
									<td><?= $contact->photo->survey3?></td>
									<td><?= $contact->photo->survey4?></td>
									<td><?= $contact->photo->survey5?></td>
									<td><?= ($contact->photo->survey6 == 'Yes') ?  1 : 0 ?></td>
									<td><?= ($contact->photo->survey7 == 'Yes') ?  1 : 0 ?></td>
									<td class="kl_theDateprisePhoto"><?php if(!empty($contact->photo->date_prise_photo)) echo $contact->photo->date_prise_photo->format('d-m-y').$contact->photo->heure_prise_photo->format(' à H\hi'); ?></td>
                                
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
<?php } else { ?>
<div class="kl_contPasAlbums text-center m-t-15"> 
    <?= $this->Html->image('pasAlbums.png', ['alt' => 'Aucune photo']); ?>
    <div class="kl_aucuneDiv">Aucun contact</div>
</div>
<?php } ?>
</div>
