<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>


<?php
$titrePage = "Tableau de bord : ".$client->nom;
$this->assign('title', $titrePage);
$this->start('breadcumb');


$this->Breadcrumbs->add(
'Clients',
['controller' => 'Clients', 'action' => 'index']
);

$this->Breadcrumbs->add(
$client->nom,
['controller' => 'Clients', 'action' => 'view', $client->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>
<div class="row">
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php
            $isPageSouvenir = 'Non';
            if(!empty($custom)){
                if(!empty($custom->signature_email) 
                    || !empty($custom->ps_publicite)
                    || !empty($custom->ps_couleur_de_fond)
                    || !empty($custom->ps_couleur_download_link)
                ){
                    $isPageSouvenir = 'Oui';
                }
                
            }
            echo $this->Html->link('<h1 class="font-light text-white">'.$isPageSouvenir.'</h1><h6 class="text-white">Page souvenir</h6>', ['controller'=>'ClientsCustoms','action' => 'pageSouvenir', $client->id],['escapeTitle'=>false,'class'=>'box text-center']);
            ?>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-selfizee">
            <?php          
            $isGalerieSouvenir = 'Non';
            if(!empty($custom)){
                if(!empty($custom->gs_is_livredor_active) 
                    || !empty($custom->gs_couleur)
                    || !empty($custom->gs_titre)
                    || !empty($custom->gs_sous_titre)
                    || !empty($custom->img_banniere_file)
                ){
                    $isGalerieSouvenir = 'Oui';
                }
                
            }
            echo $this->Html->link('<h1 class="font-light text-white">'.$isGalerieSouvenir.'</h1><h6 class="text-white">Galerie Souvenir</h6>', ['controller'=>'ClientsCustoms','action' => 'galerieSouvenir', $client->id],['escapeTitle'=>false,'class'=>'box text-center']);
            ?>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <a href="<?= $this->Url->build(['controller' => 'ClientsModelesEmails', 'action' => 'index', $client->id]) ?>">
            <div class="card card-selfizee">
                <div class="box text-center">
                    <h1 class="font-light text-white"><?= $countModeleEmail ?></h1>
                    <h6 class="text-white"><?= $countModeleEmail > 1 ? "Modèles e-mail" : "Modèle e-mail" ?></h6>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <a href="<?= $this->Url->build(['controller' => 'ClientsModelesSmss', 'action' => 'index', $client->id]) ?>">
            <div class="card card-selfizee">
                <div class="box text-center">
                    <h1 class="font-light text-white"><?= $countModeleSms ?></h1>
                    <h6 class="text-white"><?= $countModeleSms > 1 ? "Modèles sms" : "Modèle sms" ?></h6>
                </div>
            </div>
        </a>
    </div>
</div>