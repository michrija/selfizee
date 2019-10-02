<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Catalogue[]|\Cake\Collection\CollectionInterface $catalogues
 */
?>


<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Catalogues de cadres</h4>
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Catalogue</th>  
                                                <th>Theme</th>  
                                                <th>Format</th>                                                 
                                                <th class="text-nowrap">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cadre_catalogues as $cadre) { ?>
                                                <tr>
                                                    <td><?php if($cadre->catalogue) echo ($cadre->catalogue->nom) ?></td>
                                                    <td><?php if($cadre->theme) echo ($cadre->theme->nom) ?></td>
                                                    <td><?php if($cadre->format) echo ($cadre->format->nom) ?></td>
                                                    <td class="actions">
                                                        <?= $this->Html->link(__('Edit'), ['action' => 'cadre', $idEvenement, $cadre->id]) ?>
                                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cadre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cadre->id)]) ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>