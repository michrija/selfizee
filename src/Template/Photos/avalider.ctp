<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?= $this->Html->css('photos/popup_photo.css?v1_190213') ?>
<?php $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?php $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?php //$this->Html->script('https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', ['block' => true]) 
    echo $this->Html->script('mp-mansory/mp.mansory.min.js', ['block' => true]);
    echo $this->Html->script('photos/corbeille.js', ['block' => true]);
    echo $this->Html->script('photos/avalider.js', ['block' => true]);
?>

<?php
$titrePage = "Photo en attente de validation" ;
if($countPhotoNonValider > 1){
   $titrePage = "Photos en attente de validation" ; 
}
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
<div class="row el-element-overlay">
    <div class="col-md-12">
        <div class="pull-left">
            <h4 class="card-title"><?= $this->Paginator->counter(['format' => __('{{count}} Photo(s)')]) ?></h4>
        </div>
        <div class="pull-right">
            <?php
                echo $this->Form->postLink('<i class="mdi mdi-refresh"></i> Tout valider',['action'=>'toutValider', $evenement->id],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 m-r-10 btn-selfizee-inverse" ]);
                echo $this->Html->link('<i class="mdi mdi-keyboard-backspace"></i> Retour',['action'=>'liste', $evenement->id],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 m-r-10 btn-selfizee-inverse" ]); 
            ?>
        </div>
        <div class="clearfix"></div>
	</div>
    <div class="clearfix"></div>
  
    
    <div class="kl_listePhoto row col-12" id="id_photoListe">
        <?php foreach($photos as $key => $photo){ ?>
        <div class="kl_onePhoto" data-order="<?= $key ?>" id="id_onePhoto_<?= $photo->id ?>">
            <div class="card-one">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1"> <img src="<?= $photo->url_thumb_bo ?>" alt="<?= $photo->created ?>" />
                        <div class="el-overlay">
                            <ul class="el-info">
                                <li>
                               <!-- <a class="btn default btn-outline image-popup-vertical-fit" href="<?= $photo->url_photo ?>"><i class="icon-magnifier"></i></a>-->
                                <?php echo $this->Html->link('<i class="icon-magnifier"></i> ',['controller'=>'Photos','action'=>'getAvalider', $photo->id, '_full' => true],['escape'=>false,"class"=>"btn default btn-outline kl_viewImage" ]);  ?>
                                </li>
                                <li>
                                    <?= $this->Form->postLink('<i class="icon-close "></i> Refuser', ['action' => 'refuser', $photo->id], ['escapeTitle'=>false,'class'=>'btn default btn-danger','confirm' => __('Etes vous sûr de vouloir supprimer defitivement  ?', $photo->id)]) ?>
                                </li>
                                <li>
                                    <?= $this->Form->postLink('<i class="icon-check"></i> Valider', ['action' => 'valider', $photo->id], ['escapeTitle'=>false,'class'=>'btn default btn-danger m-t-10']) ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>
<div class="kl_thePaginate">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
</div>