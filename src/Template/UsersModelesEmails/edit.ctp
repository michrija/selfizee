<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersModelesEmail $usersModelesEmail
 */
?>

<?= $this->Html->css('html5-editor/bootstrap-wysihtml5.css', ['block' => true]) ?>
<?= $this->Html->script('html5-editor/wysihtml5-0.3.0.js', ['block' => true]); ?>
<?= $this->Html->script('html5-editor/bootstrap-wysihtml5.js', ['block' => true]); ?>

<?= $this->Html->script('UserCustomes/add.js', ['block' => true]); ?>

<?php
$titrePage = "Modification modèle email";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Utilisateurs',
['controller' => 'Users', 'action' => 'index']
);

$this->Breadcrumbs->add(
$user->username,
['controller' => 'Users', 'action' => 'view', $user->id]
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => ""]);
$this->end();

?>
<div class="row">

    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($usersModelesEmail) ?>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-12">
                            <?php echo $this->Form->control('user_id',['type' => 'hidden', 'value'=>$user->id]); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('nom_modele',['label'=>'Nom du modèle :', 'required'=>true]); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('email_expediteur',['label'=>'E-mail de l\'expéditeur : ', 'type'=>'email']); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('nom_expediteur',['label'=>'Nom de l\'expéditeur : ']); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('objet',['label'=>'Objet :','type'=>'text','templateVars' => ['help' => 'Astuce : synthaxe pouvant être utilisée dans l\'objet du mail : [[email]], [[prenom]], [[nom]], [[lien_partage]]']]); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('content',['label'=>'Contenu', 'type'=>'textarea','class'=>'form-control textarea_editor','rows'=>'20', 'templateVars' => ['help'=>'Astuce : synthaxe pouvant être utilisée dans le corps de mail : [[email]], [[prenom]], [[nom]], [[lien_partage]], [[miniature]], [[miniature_lien]]']]); ?>
                        </div>

                        <div class="col-md-12">
                            <?php echo $this->Form->control('is_photo_en_pj',['label'=>'Photo en pièce jointe','type'=>'checkbox']); ?>
                        </div>

                    </div>

                    <div class="form-actions">
                        <?= $this->Form->button('<i class="fa fa-check"></i> '.__('Save'),["class"=>"btn btn-success",'escape'=>false]) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>