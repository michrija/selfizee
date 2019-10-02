<?= $this->Html->css('Statistiques/morris.css',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/raphael-min.js',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/morris.js',['block'=>true]) ?>
<?= $this->Html->script('Statistiques/morris-data.js',['block'=>true]) ?>
<?php
$titrePage = "Statistique récapitulatif";
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
<div class="row kl_bloc_recap">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body kl_stat_quotidienne">
                <div class=""><?= $stat_quotidienne['photos_prises_now'] ?></div>
                <div class=""><?= "Photos prises aujourd'hui" ?></div>
            </div>
        </div>
    </div>
<div class="col-lg-3">
    <div class="card">
        <div class="card-body kl_stat_quotidienne">
            <div class=""><?= $stat_quotidienne['email_envoyes_now'] ?></div>
            <div class=""><?= "Email envoyés aujourd'hui" ?></div>
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="card">
        <div class="card-body kl_stat_quotidienne">
            <div class=""><?= $stat_quotidienne['sms_envoyes_now'] ?></div>
            <div class=""><?= "Sms envoyés aujourd'hui" ?></div>
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="card">
        <div class="card-body kl_stat_quotidienne">
            <div class=""><?= $stat_quotidienne['photo_telechargees_now'] ?></div>
            <div class=""><?= "Photos téléchargées aujourd'hui" ?></div>
        </div>
    </div>
</div>
</div>
<!-- Row -->
<div class="row">    
    <textarea class="hidden" id="axe_y_id"><?= json_encode($axe_y) ?></textarea>
    <textarea class="hidden" id="labels_id"><?= json_encode($labels) ?></textarea>
    <textarea class="hidden" id="data_id"><?= json_encode($stats) ?></textarea>
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <ul class="list-inline text-left">
                                    <?php $colors = ['text-inverse', 'text-info', 'text-success', 'text-warning']; 
                                        foreach($labels as $key => $label) { ?>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5 <?= $colors[$key] ?>"></i><?= $label ?></h5>
                                    </li>
                                    <?php } ?>
                                    <!--<li>
                                        <h5><i class="fa fa-circle m-r-5 text-info"></i>iPad</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5 text-success"></i>iPod</h5>
                                    </li>-->
                                </ul>
                                <div id="morris-area-chart"></div>
                                <?php $disabled_prev = ""; if($page-1 == 0) $disabled_prev = "disabled" ?>
                                <?php $disabled_next = ""; if($nbr_pagination == $page) $disabled_next = "disabled" ?>
                                <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item <?= $disabled_prev ?>">
                                                    <?php echo $this->Html->link('<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>','/statistiques/recap-graphique/'.$idEvenement.'/'.($page-1), ['class' => 'page-link', 'escape'=>false]);?>
                                                </li>
                                                <?php 
                                                    if($nbr_pagination > 9) $nbr_pagination = 9;
                                                    for($pagination=1; $pagination <= $nbr_pagination ;$pagination++) { 
                                                        $active = "";
                                                        if($page == $pagination) $active = "active" ; ?>
                                                <li class="page-item <?= $active ?>">
                                                    <?php echo $this->Html->link($pagination, '/statistiques/recap-graphique/'.$idEvenement.'/'.$pagination, ['class' => 'page-link']);?>
                                                </li>
                                                <?php } ?>
                                                <li class="page-item <?= $disabled_next ?>">
                                                    <?php echo $this->Html->link('<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>','/statistiques/recap-graphique/'.$idEvenement.'/'.($page+1), ['class' => 'page-link', 'escape'=>false]);?>
                                                </li>
                                            </ul>
                                </nav>
                            </div>            
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->