<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OptionBorne $optionBorne
 */
?>

<?php
$titrePage = "Options bornes";
$this->assign('title', $titrePage);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($optionBorne) ?>
                    <?php
                        echo $this->Form->control('chemin_dossier_assets',['type'=>'text']);
                        echo $this->Form->control('chemin_dossier_events',['type'=>'text']);
                        echo $this->Form->control('chemin_dossier_presets',['type'=>'text']);
                        echo $this->Form->control('fichier_setting_base',['label'=>'Fichier Setting de base',"rows"=>"100"]);
                        echo $this->Form->control('ftp_server');
                        echo $this->Form->control('ftp_username');
                        echo $this->Form->control('ftp_password');
                        echo $this->Form->control('ftp_port');
                    ?>
                    <div class="form-actions m-t-10">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
    </div>
</div>
