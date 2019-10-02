<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelBorne $modelBorne
 */
?>
<?php
$titrePage = "Paramètres du compte" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
    'Dashboards',
    ['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();


?>


<div class="clearfix"></div>
<div class="row">
<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"><?= $titrePage ?></h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
                <div class="form-body">
                     <div class="col-md-6">
                        <?php
                            
                            echo $this->Form->control('username',['label'=>'Login']);
                            echo $this->Form->control('pasafficherparnavigagauet',['class'=>'hide','type'=>'password','label' => false]);
                            echo $this->Form->control('password',['label'=>'Mot de passe','type'=>'text','value' => '', 'required'=>false]);
                            
                        ?>
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
                