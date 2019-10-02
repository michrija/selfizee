<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EvenementPost[]|\Cake\Collection\CollectionInterface $evenementPosts
 */
?>

<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css', ['block' => true]) ?>
<?php echo  $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js', ['block' => true]) ?>
<?= $this->Html->script('summernote/summernote-fr-FR.min.js', ['block' => true]); ?> 
<?= $this->Html->script('summernote/summernote-image-attributes.js', ['block' => true]); ?>
<?= $this->Html->script('summernote/fr-FR.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/acces.js', ['block' => true]); ?>

<?php

$titrePage = "Tableau de bord des contenus";
$this->assign('title', $titrePage);
$this->start('breadcumb');

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();


$this->start('actionTitle');
    echo $this->Html->link('<i class="mdi mdi-plus-circle"></i> '.__('Create'),['action'=>'add', $idEvenement],['escape'=>false,"class"=>"btn pull-right hidden-sm-down btn-success0 btn-selfizee-inverse" ]);                     
$this->end();

//debug($timelines->toArray());
?>

<div class="row">
    <div class="col-12">
        <div class="card card-new-selfizee" >
            <div class="card-header border-bottom">
                <h4 class="m-b-0 text-black pull-left"><?= $titrePage ?> </h4>
                <?php
                echo $this->Html->link(__('Ajouter une nouvelle page'),['action'=>'add', $idEvenement],['escape'=>false,"class"=>"kl_linkToListeFonctionnalite pull-right" ]); 
                ?>
            </div>
            <div class="card-body">
                <?php if(count($evenementPosts->toArray())){ ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('titre') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach ($evenementPosts as $evenementPost){ ?>
                            <tr>
                                <td><?= h($evenementPost->titre) ?></td>
                                <td><?= h($evenementPost->slug) ?></td>
                                <td class="actions">
                                    <?php //echo $this->Html->link(__('View'), ['controller' => 'rgpd', 'action' => 'post', 'slug' => $evenementPost->slug], ['target' => '_blank']) ?>
                                    <?= $this->Html->link(__('View'), $url_content_domaine.$idEvenement.'/'.$evenementPost->slug, ['target' => '_blank']) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evenementPost->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evenementPost->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evenementPost->titre)]) ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->first('<< ' . __('first')) ?>
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                            <?= $this->Paginator->last(__('last') . ' >>') ?>
                        </ul>
                    </div>
                </div>
                <?php }else{ ?>
                    <div>Aucune page de contenu</div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>


