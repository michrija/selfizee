<?= $this->Html->css('magnific-popup/magnific-popup.css', ['block' => true]) ?>
<?php $this->Html->script('magnific-popup/jquery.magnific-popup.min.js', ['block' => true]); ?>
<?php $this->Html->script('magnific-popup/jquery.magnific-popup-init.js', ['block' => true]); ?>
<?php //$this->Html->script('https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', ['block' => true]) 
    echo $this->Html->script('mp-mansory/mp.mansory.min.js', ['block' => true]);
    echo $this->Html->script('photos/corbeille.js', ['block' => true]);
?>
<?= $this->Html->css('evenements/board.css', ['block' => true]) ?>

<?php
$titrePage = "Corbeille" ;
?>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card card-new-selfizee">
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?></h4>
                <div class="pull-right"> 
                <?php
                    if($userConnected['is_active_acces_edit_photo']){
                        echo $this->Form->postLink('<i class="mdi mdi-delete"></i> Vider',['action'=>'viderCorbeille', $evenement->id],['escape'=>false,"class"=>"kl_bntLinkSimpleCustom pull-right btn-selfizee",'confirm'=>'Etes vous sûr de vouloir tout supprimer ?']);
                        echo $this->Form->postLink('<i class="mdi mdi-refresh"></i> Tout restaurer',['action'=>'restaurerCorbeille', $evenement->id],['escape'=>false,"class"=>"kl_bntLinkSimpleCustom pull-right btn-selfizee m-r-15" ]);
                    }
                    echo $this->Html->link('<i class="mdi mdi-keyboard-backspace"></i> Retour',['action'=>'liste', $evenement->id],['escape'=>false,"class"=>"kl_bntLinkSimpleCustom pull-right btn-selfizee m-r-15" ]);
                ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <div class="kl_titreTop">
                    <div class="kl_syntheseEvent pull-left">Contenu de la corbeille :</div>
                    <div class="clearfix"></div>
                </div>
                <div class="row kl_statTop">
                    <?php if(!empty($countPhotoInCorbeille)){ ?>
                    <div class="col-md-2 kl_nopadding">
                        <a href="javascript:void(0)">
                            <div class="kl_oneStatCount text-center">
                                <span class="kl_statNbrValue"><?= $countPhotoInCorbeille ?></span> 
                                <?= $countPhotoInCorbeille>1 ? "Photos" :"Photo" ?>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>

        <div class="card card-new-selfizee">
            <div class="card-body">
                <div class="kl_listePhoto row col-12 el-element-overlay m-t-15" id="id_photoListe">
                        <?php foreach($photos as $key => $photo){ ?>
                        <div class="kl_onePhoto" data-order="<?= $key ?>" id="id_onePhoto_<?= $photo->id ?>">
                            <div class="card-one">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1"> <img src="<?= $photo->url_thumb_bo ?>" alt="<?= $photo->created ?>" />
                                        <div class="el-overlay">
                                            <ul class="el-info">
                                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="<?= $photo->url_photo ?>"><i class="icon-magnifier"></i></a></li>
                                                <li>
                                                    <?= $this->Form->postLink('<i class="icon-close "></i>', ['action' => 'delete', $photo->id], ['escapeTitle'=>false,'class'=>'btn default btn-danger','confirm' => __('Etes vous sûr de vouloir supprimer defitivement  ?', $photo->id)]) ?>
                                                </li>
                                                <li>
                                                    <?= $this->Form->postLink('<i class="icon-reload"></i> Restaurer', ['action' => 'restaurer', $photo->id], ['escapeTitle'=>false,'class'=>'btn default btn-danger']) ?>
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
                <div class="kl_thePaginate">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>