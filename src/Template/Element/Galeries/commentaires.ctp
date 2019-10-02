<?= $this->Html->script('GalerieCommentaires/add.js'); ?>
<div class="kl_textRemerciement">
    <?php if(!empty($galery->desc)) {?>
        <div class="kl_blocDesc">
            <span>“</span>
            <?= $galery->desc ?>
            <span>”
            </span>
        </div>
     <?php }?>
</div>
<div class="container">
    <div class="kl_formCommentaire">
        <h4>Laisser un commentaire </h4>
        
        <?= $this->Form->create($galerieCommentaire, ['url' => ['controller' => 'GalerieCommentaires', 'action' => 'add'], 'id'=>'galerieCommentaire', 'class'=>'kl_commentaire']) ?>
        <?php
            echo $this->Form->control('commentaire',['id'=>'id_commentaire',"placeholder"=>"Votre commentaire *", 'required' => true,'label'=>false]);
            echo $this->Form->control('commentateur_name',['id'=>'id_commentateurName',"required"=>true,'label'=>false,"placeholder"=>"Votre nom *"]);
            echo $this->Form->hidden('galerie_id', ['value' => $galery->id]);
        ?>
        
        <?= $this->Form->submit(__('Commenter'),['id'=>'id_sendCommentaire',"class"=>"pull-right"]) ?>
        
        <?= $this->Form->end() ?>
        <div class="clearfix"></div>
    </div>
    <div id="id_contentCommentaire"></div>
</div>