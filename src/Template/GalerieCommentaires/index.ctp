<?php if(!empty($galerieCommentaires->toArray())) { ?>
<div class="kl_allComments">
    <div class="kl_liste_commentaire">
       <div class="kl_topCommentaire">
          <div class="pull-left"><span id="count_comment"><?= $this->Paginator->counter(['format' => __('{{count}} commentaire(s)')]) ?></span> </div>
          <div class="pull-right kl_filtreCommentaire">
                   
                <?php 
                    $params = $this->Paginator->params();
                    $last = $params["count"];  
                    
                    $nbres = [25=>'25 par page',50=>'50 par page',100=>'100 par page'];
                    if($last>25){
                        echo $this->Form->select('maxLimit', $nbres, 
                                [
                                 'id'=>'id_maxLimit',
                                 'class'=>'selectpicker',
                                 'empty'=>[$last=>'Afficher tout'],
                                 'default' => $maxLimit,
                                 'label' => 'Affichage par'
                                ]); 
                    }
                 ?>
             
          </div>
          <div class="clearfix"></div>
       </div>
    </div>
    <div class="kl_contCommentaire" id="bloc_comment">
       <?php foreach ($galerieCommentaires as $galerieCommentaire): ?>
       <div class="kl_blocCommentaire">
          <div cl1ass="kl_BlocComm">
             <div class="kl_nameCom"><?= $galerieCommentaire->commentateur_name ?></div>
             <div class="kl_dateCom"><?= $galerieCommentaire->created ?></div>
             <div class="kl_textCom"><?= $galerieCommentaire->commentaire ?></div>
          </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php } ?>