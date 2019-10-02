<!-- Sous menu -->
<?php use Cake\Routing\Router; ?>
<?php if(!empty($evenement->id)) { ?>
<div class="" id="id_theSousMenu">
    <div class="kl_sousMenu">
        <div class="kl_customBreadCumb">
            <a href="<?= Router::url(['controller' => 'Evenements','action' => 'index']) ?>"><span>événements</span></a><i class="fa fa-chevron-right kl_iconSup"></i>

            <a href="<?= Router::url(['controller' => 'Evenements','action' => 'edit',$evenement->id]) ?>" class="<?= $this->request->getParam('action') == 'edit' ? 'active' : ''; ?>"><span><?= $evenement->nom ?></span><i class="fa fa-edit kl_iconEdit"></i></a>

        </div>
        <div class="kl_dateEtVille">
            <?php 
            if(!empty($evenement->date_debut) && !empty($evenement->date_fin)){ 
            ?>
                <span>Du <?= $evenement->date_debut->format('d/m/Y') ?>  au <?= $evenement->date_fin->format('d/m/Y') ?> </span>
            <?php } ?> 
            <?php if(!empty($evenement->ville)){ ?>
                <span class="kl_theVille"> - <?= $evenement->ville ?></span>
            <?php } ?>
            
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php } ?>