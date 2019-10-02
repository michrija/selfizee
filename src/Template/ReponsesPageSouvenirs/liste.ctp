<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReponsesPageSouvenir[]|\Cake\Collection\CollectionInterface $reponsesPageSouvenirs
 */
?>

<?php
$titrePage = "Reponses page souvenir" ;
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <?php if(!empty($champs) && !empty($reponses_list)) { ?>
            <div class="table-responsive">
                    <table class="table">
                        <thead>
            <tr>
                <th scope="col">Photo</th>
                <?php foreach ($champs as $key => $champ) { ?>
                    <th scope="col"><?= $champ ?></th>
                <?php } ?>
                <th scope="col">Date</th>
            </tr>
        </thead>
                        <tbody>
            <?php foreach ($reponses_list as $i => $reponse) { ?>
                <tr>
                    <td><?= $this->Html->image($reponse['photo'],['width'=>75]); ?></td>

                    <td><?= $reponse[0] ?></td>
                    <?php if(count($champs) >= 2) {?>
                    <td><?= $reponse[1] ?></td>
                    <?php } ?>
                    <?php if(count($champs) >= 3) {?>
                    <td><?= $reponse[2] ?></td>
                     <?php } ?>
                    <?php if(count($champs) >= 4) {?>
                    <td><?= $reponse[3] ?></td>
                     <?php }  ?>
                    <?php if(count($champs) >= 5) {?>
                    <td><?= $reponse[6] ?></td>
                     <?php } ?>
                    <?php if(count($champs) >= 6) {?>
                    <td><?= $reponse[7] ?></td>
                     <?php } ?> 
                     <td><?= $reponse['date'] ?></td>                   
                </tr>
            <?php } ?>
        </tbody>
                        <!--<tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="text-right">
                                    <ul class="pagination">
                                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                        <?= $this->Paginator->numbers() ?>
                                        <?= $this->Paginator->next(__('next') . ' >') ?>
                                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tfoot>-->
                    </table>
                </div>
            <?php } else { ?>
            <p style="text-align: center;">Aucun infos</p>
            <?php } ?>
            </div>
        </div>
    </div>
</div>