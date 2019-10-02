<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelBorne $modelBorne
 */
?>

<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-select/bootstrap-select.min.js', ['block' => true]); ?>
<?= $this->Html->script('multiselect/jquery.multi-select.js', ['block' => true]); ?>

<?= $this->Html->css('select2/select2.min.css', ['block' => true]) ?>
<?= $this->Html->css('bootstrap-select/bootstrap-select.min.css', ['block' => true]) ?>
<?= $this->Html->css('multiselect/multi-select.css', ['block' => true]) ?>

<?= $this->Html->script('facebookAutos/selectAlbum.js',["type"=>"application/javascript","block"=>true]) ?>

<?php
$titrePage = "Publication automatique sur Facebook" ;
$this->assign('title', $titrePage);
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
<div class="col-lg-12">
     <div class="card card-new-selfizee" >
        <div class="card-header border-bottom">
            <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?> </h4>
        </div>
        <div class="card-body">
             <?php echo $this->Form->create(null,array('id'=>'pagesfb_data')); ?>
                <div class="form-body">
                    <div class="row p-t-20">
                         <?php 
                        $kl_selectEvent = "";
                        if(!empty($idEvenement)){ 
                            $kl_selectEvent = "hide";
                        } 
                     ?>
                     <div class="col-md-12">
                        <div class="form-group <?= $kl_selectEvent ?>">
                            <?php
                                    echo $this->Form->control('evenement_id', [
                                        'id'=>'id_albumPiktoo',
                                        'type' => 'select',
                                        'multiple' => false,
                                        'options' => $evenements,
                                        'required'=>true,
                                        'class' => 'select2',
                                        'empty'=>__('Séléctionnez un événement'),
                                        'value' => $idEvenement,
                                        'label' => 'Séléctionner un événement'
                                    ]);
                                ?>
                        </div>
                      
                    
                    
                            <?php
                                
                               $pageFabookName = array(); 
                                if(isset($allPageFacebook['accounts'])){
                                    foreach ($allPageFacebook['accounts']['data'] as $k=>$data) {
                                        $pageFabookName[$data['id']] = $data['name'];
                                        echo '<input type="radio" id="id_page_'.$data['id'].'" value="'.$data['access_token'].'" name="tokePageFacebook" class="hide" />';
                                        echo '<input type="radio" id="id_page_name_'.$data['id'].'" value="'.$data['name'].'" name="namePageFacebook" class="hide" />';
                                    }
                                }
                               
                                echo $this->Form->control('pageFacebook', [
                                    'id'=>'id_pageFacebook',
                                    'type' => 'select',
                                    'multiple' => false,
                                    'options' => $pageFabookName,
                                    'label' => 'Séléctionnez une Page Facebook',
                                    'required'=>true,
                                    'class' => 'select2 form-control',
                                    'empty'=>__('Séléctionnez une Page Facebook')
                                ]);
                             ?>
                           </div>                   
                    </div>
                   
                </div>
                <div class="form-actions">
                    <?= $this->Form->button('<i class="fa fa-check"></i> Suivant',["class"=>"btn btn-success",'escape'=>false]) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
                