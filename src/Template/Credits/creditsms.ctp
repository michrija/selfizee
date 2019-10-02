<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->script('clients/add.js', ['block' => true]); ?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Credit $credit
 */
$titrePage = "Crédits SMS" ;
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Dashboards',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();


$this->start('actionTitle');
    //echo $this->Html->link('<i class="mdi mdi-plus-circle"></i>Demander un crédit',['action'=>'demande', $client->id],['escape'=>false,"class"=>"btn pull-right hidden-sm-down  btn-selfizee-inverse" ]);           
$this->end();

?>
<?= $this->Html->css('evenements/board.css', ['block' => true]) ?>

<div class="row el-element-overlay">
    <div class="col-md-12">
        <div class="card card-new-selfizee">
            <div class="card-header ">
              <h4 class="m-b-0 text-black pull-left">Gestion des crédits sms </h4>
              <div class="clearfix mb-5"></div>
              <p>Pour pouvoir partager les photos par sms à vos utilisateurs,vous devez au préalable avoir du crédit sur votre compte .</p>
            </div>
            <div class="card-body">
                <div class="row ">
                    <div class="col-md-8 kl_nopadding ">
                        <div class="kl_oneStatCount text-center row">
                           <div class="col-6 ">
                            <?php //debug($smsInfos); ?>
                              <span class="kl_statNbrValue" style="margin-left: 10%"><?= @$infoCreditClient['creditDisponible'] ?> sms restants</span>
                           </div>
                            <div class="col-6 ">
                              <?php echo $this->Html->link('CREDITER LE COMPTE',['action'=> 'buy-sms',@$eventId, @$infoCreditClient['client']],['escape'=>false,"class"=>"btn btn-danger" ]);  ?>

                              <!--  <button class="btn btn-danger pr-5 pl-5"></button> -->
                            </div>
                        </div>
                        <div class="mt-5 m-b-10">
                             <h4 class=" text-black ">Synthèse de vos dérniers envois :</h4>
                        </div>
                        <br>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="40%" >Campagne</th>
                                            <th  width="20%"  >Envoies</th>
                                            <th  width="20%"  >Derniere envoie</th>
                                            <th  width="20%"  >Détails </th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                   
                                    <?php if (!is_null($dernieres_demande_crdt)): ?>
                                            <?php if(!is_null($dernieres_demande_crdt->toArray()) && !empty($dernieres_demande_crdt->toArray()) ) { ?>
                                            <?php foreach($dernieres_demande_crdt as $demande_crdt ) { ?> 
                                        <tr>
                                           <td ><?= $demande_crdt->evenement_name ?></td>
                                           <td><?= $demande_crdt->credit ?> envoies</td>
                                           <td><?= $demande_crdt->created->format('d/m/Y') ?></td>
                                           <td> <?php echo $this->Html->link('<i class="fa fa-search pl-5" aria-hidden="true"></i>',['action'=> 'index',@$infoCreditClient['client']],['escape'=>false,"class"=>"" ]);  ?></td>
                                        
                                        </tr>       
                                            <?php } } else {?>   
                                            <tr><td colspan="3" style="text-align: center;">Aucune demande</td></tr>  
                                            <?php } ?> 
                                             <?php endif ?>              
                                    </tbody>
                              
                                </table>
                            </div>
                        </div>
            
                    </div>
                    <div class="col-md-4">
                        <h4 class="m-t-30 ml-5">Le saviez - vous ?</h4>
                    </div>
                </div>
                <div class="mt-3">
                    <h4 class="m-b-0 text-black">Facture:</h4>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="20%" ></th>
                                    <th width="20%" ></th>
                                    <th width="20%" ></th>
                                    <th width="40%" ></th>
                                
                                </tr>
                            </thead>
                            <tbody> 
                             
                                <?php if (!is_null($dernieres_demande_crdt)): ?>
                                    <?php if(!is_null($dernieres_demande_crdt->toArray()) && !empty($dernieres_demande_crdt->toArray()) ) { ?>
                                    <?php foreach($dernieres_demande_crdt as $demande_crdt ) { ?> 
                                <tr>
                                   <td><?= $demande_crdt->created->format('d/m/Y') ?></td>
                                   <td> <?= $demande_crdt->prix ?> €</td>
                                   <td> <?= $demande_crdt->credit ?> sms</td>
                                   <td style="padding-left: 30%"> <?php echo $this->Html->link('<span class="fa fa-file-o"></span>pdf',['action'=> 'facture',@$demande_crdt->id.'.pdf'],['escape'=>false,"class"=>"bg-white btn-sm export-pdf" ,'target'=>'_blank']);  ?></td>
            
                                </tr>       
                                  <?php } } else {?>   
                                <tr><td colspan="3" style="text-align: center;">Aucune demande</td></tr>  
                                <?php } ?> 
                                <?php endif ?>    
                  
                            </tbody>
                      
                        </table>
                    </div>
                </div>
         
          </div>
        </div>
    </div>
</div>


