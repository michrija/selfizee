<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ConfigBorne $configBorne
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Config Borne'), ['action' => 'edit', $configBorne->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Config Borne'), ['action' => 'delete', $configBorne->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configBorne->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Config Bornes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Config Borne'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evenements'), ['controller' => 'Evenements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evenement'), ['controller' => 'Evenements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Type Mise En Pages'), ['controller' => 'TypeMiseEnPages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Mise En Page'), ['controller' => 'TypeMiseEnPages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Catalogues'), ['controller' => 'Catalogues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Catalogue'), ['controller' => 'Catalogues', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taille Ecrans'), ['controller' => 'TailleEcrans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taille Ecran'), ['controller' => 'TailleEcrans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Type Imprimantes'), ['controller' => 'TypeImprimantes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type Imprimante'), ['controller' => 'TypeImprimantes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cadres'), ['controller' => 'Cadres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cadre'), ['controller' => 'Cadres', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Champs'), ['controller' => 'Champs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Champ'), ['controller' => 'Champs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configborne Has Filtres'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configborne Has Filtre'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Configborne Has Typeanimations'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configborne Has Typeanimation'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ecrans'), ['controller' => 'Ecrans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ecran'), ['controller' => 'Ecrans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fond Verts'), ['controller' => 'FondVerts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fond Vert'), ['controller' => 'FondVerts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Image Fond Verts'), ['controller' => 'ImageFondVerts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image Fond Vert'), ['controller' => 'ImageFondVerts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configBornes view large-9 medium-8 columns content">
    <h3><?= h($configBorne->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Evenement') ?></th>
            <td><?= $configBorne->has('evenement') ? $this->Html->link($configBorne->evenement->id, ['controller' => 'Evenements', 'action' => 'view', $configBorne->evenement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Mise En Page') ?></th>
            <td><?= $configBorne->has('type_mise_en_page') ? $this->Html->link($configBorne->type_mise_en_page->id, ['controller' => 'TypeMiseEnPages', 'action' => 'view', $configBorne->type_mise_en_page->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Catalogue') ?></th>
            <td><?= $configBorne->has('catalogue') ? $this->Html->link($configBorne->catalogue->id, ['controller' => 'Catalogues', 'action' => 'view', $configBorne->catalogue->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Titre Formulaire') ?></th>
            <td><?= h($configBorne->titre_formulaire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Taille Ecran') ?></th>
            <td><?= $configBorne->has('taille_ecran') ? $this->Html->link($configBorne->taille_ecran->id, ['controller' => 'TailleEcrans', 'action' => 'view', $configBorne->taille_ecran->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Imprimante') ?></th>
            <td><?= $configBorne->has('type_imprimante') ? $this->Html->link($configBorne->type_imprimante->id, ['controller' => 'TypeImprimantes', 'action' => 'view', $configBorne->type_imprimante->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($configBorne->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Decompte Prise Photo') ?></th>
            <td><?= $this->Number->format($configBorne->decompte_prise_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Max Multi Impression') ?></th>
            <td><?= $this->Number->format($configBorne->nbr_max_multi_impression) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Max Photo') ?></th>
            <td><?= $this->Number->format($configBorne->nbr_max_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Copie Impression Auto') ?></th>
            <td><?= $this->Number->format($configBorne->nbr_copie_impression_auto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Decompte Time Out') ?></th>
            <td><?= $this->Number->format($configBorne->decompte_time_out) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Borne') ?></th>
            <td><?= $this->Number->format($configBorne->num_borne) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Reprise Photo') ?></th>
            <td><?= $configBorne->is_reprise_photo ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Incrustation Fond Vert') ?></th>
            <td><?= $configBorne->is_incrustation_fond_vert ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Prise Coordonnee') ?></th>
            <td><?= $configBorne->is_prise_coordonnee ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Impression') ?></th>
            <td><?= $configBorne->is_impression ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Multi Impression') ?></th>
            <td><?= $configBorne->is_multi_impression ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Limite Impression') ?></th>
            <td><?= $configBorne->has_limite_impression ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Impression Auto') ?></th>
            <td><?= $configBorne->is_impression_auto ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Texte Impression') ?></h4>
        <?= $this->Text->autoParagraph(h($configBorne->texte_impression)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Cadres') ?></h4>
        <?php if (!empty($configBorne->cadres)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Ordre') ?></th>
                <th scope="col"><?= __('Type Cadre') ?></th>
                <th scope="col"><?= __('Config Borne Id') ?></th>
                <th scope="col"><?= __('Configuration Animation Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configBorne->cadres as $cadres): ?>
            <tr>
                <td><?= h($cadres->id) ?></td>
                <td><?= h($cadres->file_name) ?></td>
                <td><?= h($cadres->ordre) ?></td>
                <td><?= h($cadres->type_cadre) ?></td>
                <td><?= h($cadres->config_borne_id) ?></td>
                <td><?= h($cadres->configuration_animation_id) ?></td>
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
        <?php if (!empty($configBorne->champs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Type Champ Id') ?></th>
                <th scope="col"><?= __('Nom') ?></th>
                <th scope="col"><?= __('Type Donnee Id') ?></th>
                <th scope="col"><?= __('Ordre') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Config Borne Id') ?></th>
                <th scope="col"><?= __('Page Souvenir Id') ?></th>
                <th scope="col"><?= __('Type Optin Id') ?></th>
                <th scope="col"><?= __('Is Required') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configBorne->champs as $champs): ?>
            <tr>
                <td><?= h($champs->id) ?></td>
                <td><?= h($champs->type_champ_id) ?></td>
                <td><?= h($champs->nom) ?></td>
                <td><?= h($champs->type_donnee_id) ?></td>
                <td><?= h($champs->ordre) ?></td>
                <td><?= h($champs->configuration_borne_id) ?></td>
                <td><?= h($champs->config_borne_id) ?></td>
                <td><?= h($champs->page_souvenir_id) ?></td>
                <td><?= h($champs->type_optin_id) ?></td>
                <td><?= h($champs->is_required) ?></td>
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
        <h4><?= __('Related Configborne Has Filtres') ?></h4>
        <?php if (!empty($configBorne->configborne_has_filtres)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Config Borne Id') ?></th>
                <th scope="col"><?= __('Filtre Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configBorne->configborne_has_filtres as $configborneHasFiltres): ?>
            <tr>
                <td><?= h($configborneHasFiltres->id) ?></td>
                <td><?= h($configborneHasFiltres->config_borne_id) ?></td>
                <td><?= h($configborneHasFiltres->filtre_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'view', $configborneHasFiltres->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'edit', $configborneHasFiltres->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ConfigborneHasFiltres', 'action' => 'delete', $configborneHasFiltres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configborneHasFiltres->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Configborne Has Typeanimations') ?></h4>
        <?php if (!empty($configBorne->configborne_has_typeanimations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Config Borne Id') ?></th>
                <th scope="col"><?= __('Type Animation Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configBorne->configborne_has_typeanimations as $configborneHasTypeanimations): ?>
            <tr>
                <td><?= h($configborneHasTypeanimations->id) ?></td>
                <td><?= h($configborneHasTypeanimations->config_borne_id) ?></td>
                <td><?= h($configborneHasTypeanimations->type_animation_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'view', $configborneHasTypeanimations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'edit', $configborneHasTypeanimations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ConfigborneHasTypeanimations', 'action' => 'delete', $configborneHasTypeanimations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configborneHasTypeanimations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ecrans') ?></h4>
        <?php if (!empty($configBorne->ecrans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Page Accueil') ?></th>
                <th scope="col"><?= __('Btn Page Accueil') ?></th>
                <th scope="col"><?= __('Page Choix Configuration') ?></th>
                <th scope="col"><?= __('Page Prise Photo') ?></th>
                <th scope="col"><?= __('Page Prise Photo Visualisation') ?></th>
                <th scope="col"><?= __('Page Choix Filtre') ?></th>
                <th scope="col"><?= __('Page Remerciement') ?></th>
                <th scope="col"><?= __('Page Choix Fond Vert') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Config Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configBorne->ecrans as $ecrans): ?>
            <tr>
                <td><?= h($ecrans->id) ?></td>
                <td><?= h($ecrans->page_accueil) ?></td>
                <td><?= h($ecrans->btn_page_accueil) ?></td>
                <td><?= h($ecrans->page_choix_configuration) ?></td>
                <td><?= h($ecrans->page_prise_photo) ?></td>
                <td><?= h($ecrans->page_prise_photo_visualisation) ?></td>
                <td><?= h($ecrans->page_choix_filtre) ?></td>
                <td><?= h($ecrans->page_remerciement) ?></td>
                <td><?= h($ecrans->page_choix_fond_vert) ?></td>
                <td><?= h($ecrans->configuration_borne_id) ?></td>
                <td><?= h($ecrans->config_borne_id) ?></td>
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
        <h4><?= __('Related Fond Verts') ?></h4>
        <?php if (!empty($configBorne->fond_verts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Ordre') ?></th>
                <th scope="col"><?= __('Config Borne Id') ?></th>
                <th scope="col"><?= __('Configuration Borne Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configBorne->fond_verts as $fondVerts): ?>
            <tr>
                <td><?= h($fondVerts->id) ?></td>
                <td><?= h($fondVerts->file_name) ?></td>
                <td><?= h($fondVerts->ordre) ?></td>
                <td><?= h($fondVerts->config_borne_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Image Fond Verts') ?></h4>
        <?php if (!empty($configBorne->image_fond_verts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Config Borne Id') ?></th>
                <th scope="col"><?= __('Filename') ?></th>
                <th scope="col"><?= __('Chemin') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($configBorne->image_fond_verts as $imageFondVerts): ?>
            <tr>
                <td><?= h($imageFondVerts->id) ?></td>
                <td><?= h($imageFondVerts->config_borne_id) ?></td>
                <td><?= h($imageFondVerts->filename) ?></td>
                <td><?= h($imageFondVerts->chemin) ?></td>
                <td><?= h($imageFondVerts->created) ?></td>
                <td><?= h($imageFondVerts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ImageFondVerts', 'action' => 'view', $imageFondVerts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ImageFondVerts', 'action' => 'edit', $imageFondVerts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ImageFondVerts', 'action' => 'delete', $imageFondVerts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imageFondVerts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
