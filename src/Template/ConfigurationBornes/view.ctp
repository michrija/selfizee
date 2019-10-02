<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigurationBorne $configurationBorne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuration Borne'), ['action' => 'edit', $configurationBorne->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuration Borne'), ['action' => 'delete', $configurationBorne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configurationBorne->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Configuration Bornes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration Borne'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Type Animations'), ['controller' => 'TypeAnimations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Animation'), ['controller' => 'TypeAnimations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Multiconfigurations'), ['controller' => 'Multiconfigurations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Multiconfiguration'), ['controller' => 'Multiconfigurations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Type Imprimantes'), ['controller' => 'TypeImprimantes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Imprimante'), ['controller' => 'TypeImprimantes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Model Bornes'), ['controller' => 'ModelBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model Borne'), ['controller' => 'ModelBornes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cadres'), ['controller' => 'Cadres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cadre'), ['controller' => 'Cadres', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ecrans'), ['controller' => 'Ecrans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ecran'), ['controller' => 'Ecrans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Filtre Configuration Bornes'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Filtre Configuration Borne'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fond Verts'), ['controller' => 'FondVerts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['controller' => 'FondVerts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configurationBornes view large-9 medium-8 columns content">
    <h3><?= h($configurationBorne->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $configurationBorne->has('evenement') ? $this->Html->link($configurationBorne->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $configurationBorne->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Animation') ?></th>
            <td><?= $configurationBorne->has('type_animation') ? $this->Html->link($configurationBorne->type_animation->id, ['controller' => 'TypeAnimations', 'action' => 'view', $configurationBorne->type_animation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Multiconfiguration') ?></th>
            <td><?= $configurationBorne->has('multiconfiguration') ? $this->Html->link($configurationBorne->multiconfiguration->id, ['controller' => 'Multiconfigurations', 'action' => 'view', $configurationBorne->multiconfiguration->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Imprimante') ?></th>
            <td><?= $configurationBorne->has('type_imprimante') ? $this->Html->link($configurationBorne->type_imprimante->id, ['controller' => 'TypeImprimantes', 'action' => 'view', $configurationBorne->type_imprimante->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model Borne') ?></th>
            <td><?= $configurationBorne->has('model_borne') ? $this->Html->link($configurationBorne->model_borne->id, ['controller' => 'ModelBornes', 'action' => 'view', $configurationBorne->model_borne->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($configurationBorne->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Pose') ?></th>
            <td><?= $this->Number->format($configurationBorne->nbr_pose) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Disposition Vignette') ?></th>
            <td><?= $this->Number->format($configurationBorne->disposition_vignette) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Decompte Prise Photo') ?></th>
            <td><?= $this->Number->format($configurationBorne->decompte_prise_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Decompte Time Out') ?></th>
            <td><?= $this->Number->format($configurationBorne->decompte_time_out) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Max Impression') ?></th>
            <td><?= $this->Number->format($configurationBorne->nbr_max_impression) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Max Photo') ?></th>
            <td><?= $this->Number->format($configurationBorne->nbr_max_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Copie Impression Auto') ?></th>
            <td><?= $this->Number->format($configurationBorne->nbr_copie_impression_auto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Reprise Photo') ?></th>
            <td><?= $configurationBorne->is_reprise_photo ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Prise Coordonnee') ?></th>
            <td><?= $configurationBorne->is_prise_coordonnee ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Impression') ?></th>
            <td><?= $configurationBorne->is_impression ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Multi Impression') ?></th>
            <td><?= $configurationBorne->is_multi_impression ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Impression Auto') ?></th>
            <td><?= $configurationBorne->is_impression_auto ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Texte Impression') ?></h4>
        <?= $this->Text->autoParagraph(h($configurationBorne->texte_impression)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Cadres') ?></h4>
        <?php if (!empty($configurationBorne->cadres)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Order') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configurationBorne->cadres as $cadres): ?>
            <tr>
                <td><?= h($cadres->id) ?></td>
                <td><?= h($cadres->file_name) ?></td>
                <td><?= h($cadres->order) ?></td>
                <td><?= h($cadres->configuration_borne_id) ?></td>
                <td><?= h($cadres->created) ?></td>
                <td><?= h($cadres->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Cadres', 'action' => 'view', $cadres->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Cadres', 'action' => 'edit', $cadres->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cadres', 'action' => 'delete', $cadres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cadres->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Champs') ?></h4>
        <?php if (!empty($configurationBorne->champs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Type Champ Id') ?></th>
                <th scope="col"><?= __('Nom') ?></th>
                <th scope="col"><?= __('Type Donnee Id') ?></th>
                <th scope="col"><?= __('Ordre') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configurationBorne->champs as $champs): ?>
            <tr>
                <td><?= h($champs->id) ?></td>
                <td><?= h($champs->type_champ_id) ?></td>
                <td><?= h($champs->nom) ?></td>
                <td><?= h($champs->type_donnee_id) ?></td>
                <td><?= h($champs->ordre) ?></td>
                <td><?= h($champs->configuration_borne_id) ?></td>
                <td><?= h($champs->created) ?></td>
                <td><?= h($champs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Champs', 'action' => 'view', $champs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Champs', 'action' => 'edit', $champs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Champs', 'action' => 'delete', $champs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ecrans') ?></h4>
        <?php if (!empty($configurationBorne->ecrans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Page Accueil') ?></th>
                <th scope="col"><?= __('Btn Page Accueil') ?></th>
                <th scope="col"><?= __('Page Prise Photo') ?></th>
                <th scope="col"><?= __('Btn Page Prise Photo') ?></th>
                <th scope="col"><?= __('Page Prise Photo Visualisation') ?></th>
                <th scope="col"><?= __('Btn Page Prise Photo Visualisation') ?></th>
                <th scope="col"><?= __('Page Choix Filtre') ?></th>
                <th scope="col"><?= __('Btn Page Choix Filtre') ?></th>
                <th scope="col"><?= __('Page Remerciement') ?></th>
                <th scope="col"><?= __('Btn Page Remerciement') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configurationBorne->ecrans as $ecrans): ?>
            <tr>
                <td><?= h($ecrans->id) ?></td>
                <td><?= h($ecrans->page_accueil) ?></td>
                <td><?= h($ecrans->btn_page_accueil) ?></td>
                <td><?= h($ecrans->page_prise_photo) ?></td>
                <td><?= h($ecrans->btn_page_prise_photo) ?></td>
                <td><?= h($ecrans->page_prise_photo_visualisation) ?></td>
                <td><?= h($ecrans->btn_page_prise_photo_visualisation) ?></td>
                <td><?= h($ecrans->page_choix_filtre) ?></td>
                <td><?= h($ecrans->btn_page_choix_filtre) ?></td>
                <td><?= h($ecrans->page_remerciement) ?></td>
                <td><?= h($ecrans->btn_page_remerciement) ?></td>
                <td><?= h($ecrans->configuration_borne_id) ?></td>
                <td><?= h($ecrans->created) ?></td>
                <td><?= h($ecrans->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ecrans', 'action' => 'view', $ecrans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ecrans', 'action' => 'edit', $ecrans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ecrans', 'action' => 'delete', $ecrans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ecrans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Filtre Configuration Bornes') ?></h4>
        <?php if (!empty($configurationBorne->filtre_configuration_bornes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Filtre Id') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configurationBorne->filtre_configuration_bornes as $filtreConfigurationBornes): ?>
            <tr>
                <td><?= h($filtreConfigurationBornes->id) ?></td>
                <td><?= h($filtreConfigurationBornes->filtre_id) ?></td>
                <td><?= h($filtreConfigurationBornes->configuration_borne_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'view', $filtreConfigurationBornes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'edit', $filtreConfigurationBornes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FiltreConfigurationBornes', 'action' => 'delete', $filtreConfigurationBornes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $filtreConfigurationBornes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fond Verts') ?></h4>
        <?php if (!empty($configurationBorne->fond_verts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Ordre') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configurationBorne->fond_verts as $fondVerts): ?>
            <tr>
                <td><?= h($fondVerts->id) ?></td>
                <td><?= h($fondVerts->file_name) ?></td>
                <td><?= h($fondVerts->ordre) ?></td>
                <td><?= h($fondVerts->configuration_borne_id) ?></td>
                <td><?= h($fondVerts->created) ?></td>
                <td><?= h($fondVerts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FondVerts', 'action' => 'view', $fondVerts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FondVerts', 'action' => 'edit', $fondVerts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FondVerts', 'action' => 'delete', $fondVerts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fondVerts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
