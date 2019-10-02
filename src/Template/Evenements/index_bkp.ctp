<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement[]|\Cake\Collection\CollectionInterface $evenements
 */
?>


<?= $this->Html->css('daterange/bootstrap-timepicker.min.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/daterangepicker.css', ['block' => true]) ?>

<?= $this->Html->script('daterange/moment.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/bootstrap-timepicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/daterangepicker.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/liste.js', ['block' => true]); ?>
<?php
$titrePage = "Liste des événements" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
/*$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Dashboards', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);*/

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

$this->start('actionTitle');
echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> Ajouter un événement',['action'=>'add'],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success" ]);
$this->end();

?>

         
        
<div class="row row mt-5">
    <div class="col-12">
    <div class="card">
        <?php if(!$isGlobal){ ?>
        <div class="kl_myOnglet">
            <?php
                $kl_activeVenir = "active";
                $kl_activePasse = "";
                if($passe){
                    $kl_activeVenir = "";
                    $kl_activePasse = "active";
                }
            ?>
            <div class="kl_oneOnglet <?= $kl_activeVenir ?>">
                <?= $this->Html->link('A venir',['action'=>'index']) ?>
            </div>
            <div class="kl_oneOnglet m-l-5 <?= $kl_activePasse ?> ">
                <?= $this->Html->link('En cours et terminés',['action'=>'index','?'=>['passe'=>1]]) ?>
            </div>
        </div>
        <?php } ?>
        <div class="card-body">
        <div class="form-body">
           <?php
            echo $this->Form->create(null, ['type' => 'get','role'=>'form']);
           ?>
           <div class="row p-3">
                <div class="col-md-2 p-l-0">
                    <?php echo $this->Form->control('key',['value'=>$key, 'label'=>false, 'class'=>'form-control search','placeholder'=>'Rechercher...']); ?>
                </div>
                <div class="col-md-2 p-l-0">
                    <?php 
                         $type = array('person'=>'Particulier', 'corporation' => 'Professionnel');
                         echo $this->Form->control('clientType',['default'=>$clientType, 'label' => false, 'options'=>$type,'empty'=>'Type','class'=>'form-control']);
            	
                    ?>
    			</div>
                
                <div class="col-md-2 p-l-0">
                    <?php 
                        $pageSouvConfOptions = ['1' => 'Oui', '2' => 'Non'];
                        echo $this->Form->select('pageSouv', $pageSouvConfOptions, ['default'=>$pageSouv,'empty' => 'Page souvernir configurée','class'=>'form-control']);
                    ?>
                </div>
                
                <div class="col-md-2 p-l-0">
                    <?php 
                        $emailConfOptions = ['1' => 'Oui', '2' => 'Non'];
                        echo $this->Form->select('emailConf', $emailConfOptions, ['default'=>$emailConf,'empty' => 'Email configuré','class'=>'form-control']);
                    ?>
                </div>
                
                <div class="col-md-2 p-l-0">
                    <?php 
                        $smsConfOptions = ['1' => 'Oui', '2' => 'Non'];
                        echo $this->Form->select('smsConf', $smsConfOptions, ['default'=>$smsConf,'empty' => 'Sms configuré','class'=>'form-control']);
                    ?>
                </div>
                
                <div class="col-md-2 p-l-0">
                    <?php 
                        $envoiConfOptions = ['1' => 'Oui', '2' => 'Non'];
                        echo $this->Form->select('envoiConf', $envoiConfOptions, ['default'=>$envoiConf,'empty' => 'Envoi configuré','class'=>'form-control']);
                    ?>
                </div>
                
                <div class="col-md-2 p-l-0">
                    <?php 
                        $fbConfOptions = ['1' => 'Oui', '2' => 'Non'];
                        echo $this->Form->select('fbAutoConf', $fbConfOptions, ['default'=>$fbAutoConf,'empty' => 'Facebook auto','class'=>'form-control']);
                    ?>
                </div>
                
                <div class="col-md-2 p-l-0">
                    <?php 
                        $photoExisteOptions = ['1' => 'Oui', '2' => 'Non'];
                        echo $this->Form->select('photoExiste', $photoExisteOptions, ['default'=>$photoExiste,'empty' => 'Photo uploadée','class'=>'form-control']);
                    ?>
                </div>
               <div class="col-md-3 p-l-0">
                    <input class="form-control input-daterange-datepicker" type="text" name="periode" value="<?php if(!empty($date_fin0)) echo $date_debut0.' - '.$date_fin0; ?>" placeholder="jj/mm/aaaa - jj/mm/aaaa" readonly="readonly" />
               </div>

               <!--<div class="col-md-2 p-l-0">
                   <input type="date" name="date_debut" class="form-control" placeholder="Date debut" id="date_debut"
                          value="<?php if(!empty($date_debut)) echo $date_debut ?>" >
               </div>à&nbsp;&nbsp;
               <div class="col-md-2 p-l-0">
                   <input type="date" name="date_fin" class="form-control" placeholder="Date fin" id="date_fin"
                          value="<?php if(!empty($date_fin)) echo $date_fin ?>">
               </div>-->
                <input type="hidden" name="passe" value="<?= $passe ?>" />
                
                <div class="col-md-3 p-l-0">
                    <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-primary'] );?>
                    <?php echo $this->Html->link('<i class="fa fa-refresh"></i>', ['action' => 'index','?'=>['passe'=>$passe]], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"btn btn-success", "escape"=>false]);   ?>         
                </div>
            
            </div>
            <?php
            echo $this->Form->end();
            ?>
        </div>
            <div class="row p-3">
                <div class="col-md-2 p-l-0">
                    <?php // $total_evenements->count()." événements" ?>
                </div>
            </div>
        <?php 
        if($passe){
            echo $this->element('Evenements/encours_termine',['evenements'=>$evenements]);    
        }else{
             echo $this->element('Evenements/avenir',['evenements'=>$evenements]);    
        }
        ?> 
    </div>
    </div>
    </div>

</div>
      
       

