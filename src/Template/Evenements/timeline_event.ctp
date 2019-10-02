<?php
$titrePage = "Timeline de l'événement";
$this->assign('title', $titrePage);
$this->start('breadcumb');


$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
$evenement->nom,
['controller' => 'Evenements', 'action' => 'view', $evenement->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();
//debug($timelines->toArray());
?>
<div class="row">

    
    <div class="col-12">
    <div class="form-body">
           <?php
            echo $this->Form->create(null, ['type' => 'get','role'=>'form']);
           ?>
           <div class="row p-3">
                <div class="col-md-2 p-l-0">
                    <?php 
                         $typeOptions = [
                            1 =>  'Upload photos',
                            2 => 'Import contact',
                            3 => 'Envoi mail',
                            4 => 'Envoi sms',
                            5 => 'Photo supprimée',
                            6 => 'Création de l\'événement',
                            7 => 'Téléchargement manuel de photo depuis la galerie' ,
                            8 => 'Téléchargement de tous les photos depuis la galerie',
                            9 => 'Upload auto vers facebook'
                         ];
                         echo $this->Form->control('type',['default' => $type, 'empty'=>'Séléctionner', 'label' => false, 'options'=>$typeOptions,'class'=>'form-control']);
            	
                    ?>
    			</div>
                
            
                
                <div class="col-md-3 p-l-0">
                    <?php echo $this->Form->button('<i class="fa fa-search"></i> Filtrer', ['label' => false ,'class' => 'btn btn-primary'] );?>
                    <?php echo $this->Html->link('<i class="fa fa-refresh"></i>', ['action' => 'timeline', $idEvenement], ["data-toggle"=>"tooltip", "title"=>"Réinitialiser", "class"=>"btn btn-success", "escape"=>false]);   ?>         
                </div>
            
            </div>
            <?php
            echo $this->Form->end();
            ?>
        </div>
    
        <?php 
      
        foreach($timelines as $timeline){
            if(!empty($timeline->date_timeline)){
                
                $depuis ="";
                if($timeline->source_timeline == 'bo' ){
                    $depuis = "depuis l'espace administration";
                }else if($timeline->source_timeline == 'auto' || $timeline->source_timeline == 'upload') {
                    $depuis = " depuis la borne";
                }else if($timeline->source_timeline == 2){
                    $depuis = "depuis la galerie souvenir";
                }
                
                //debug($timeline->date_timeline);
                $source = "";
                //debug($timeline->type_timeline);
                switch ($timeline->type_timeline) {
                    case 1: // upload photo
                        $source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
                        break;
                    case 2: //contact
                        $source = $timeline->nbr > 1 ? "contacts uploadés" : "contact uploadé";
                        break;
                    case 3: // envoi email
                        $source = $timeline->nbr > 1 ? "emails envoyés" : "email envoyé";
                        break;
                    case 4 : // sms envoyé
                        $source = $timeline->nbr > 1 ? "sms envoyés" : "sms envoyé";
                        break;
                    case 5 :
                        $source = $timeline->nbr > 1 ? "photos supprimées" : "photo supprimée";
                        break;
                    case 6 :
                        $source = 'connexion de la galerie souvenir';
                        
                        break;
                    case 7:
                        $source = $timeline->nbr > 1 ? "téléchargements photo" : "téléchargement photo";
                        break;
                    case 8:
                        $source = $timeline->nbr > 1 ? "téléchargements de tous les média" : "téléchargement de tous les média";
                        $depuis = "depuis la galerie souvenir";
                        break;
                    case 9:
                        $source = $timeline->nbr > 1 ? "photos uploadées" : "photo uploadée";
                        $depuis = "automatiquement sur facebook";
                        break;
                }
                
                
                
               
        ?>
        <div class="card">
            <div class="card-body">
                <?= $timeline->date_timeline->format('d/m/Y - H:i') ?> - <?= $timeline->nbr." ". $source ?>  <?= $depuis ?>
            </div>
        </div>
        <?php }} ?>
        <?php
            if(empty($type) || $type == 6){
        ?>
        <div class="card">
            <div class="card-body">
                 <?= $evenement->created->format('d/m/Y - H:i') ?> - Création de l'événement.
            </div>
        </div>
        <?php } ?>        
    
    </div>
</div>