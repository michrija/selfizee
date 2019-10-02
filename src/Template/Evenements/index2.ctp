<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evenement[]|\Cake\Collection\CollectionInterface $evenements
 */
?>

<?= $this->Html->css('style2.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/bootstrap-timepicker.min.css', ['block' => true]) ?>
<?= $this->Html->css('daterange/daterangepicker.css', ['block' => true]) ?>

<?= $this->Html->script('daterange/moment.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/bootstrap-timepicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('daterange/daterangepicker.js', ['block' => true]); ?>
<?= $this->Html->script('Evenements/liste.js', ['block' => true]); ?>

<!--<div class="container-fluid">-->
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <!-- Bread Crum -->
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="m-b-0 m-t-0 titre_page">Liste des événements</h3>
        </div>
        <!-- Page Tilte And Action -->
        <div class="col-md-6 col-4 align-self-center">
            <a href="/event-selfizee-v2/evenements/add" class="btn pull-right hidden-sm-down btn-success kl_btn_add_event"><i class="mdi mdi-plus-circle"></i> Ajouter un événement</a>                        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <!-- Content Page -->
    <div class="row row mt-5">
        <div class="col-12">
            <div class="card0">
                <div class="kl_myOnglet">
                    <div class="kl_oneOnglet active">
                        <a href="/event-selfizee-v2/evenements">A venir</a>            </div>
                    <div class="kl_oneOnglet m-l-5  ">
                        <a href="/event-selfizee-v2/evenements?passe=1">En cours et terminés</a>            </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-6">
                                        <h5 class="">220</h5> <span class="kl_title_info_event">évenements</span>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <h5 class="">20203</h5> <span class="kl_title_info_event">photos</span>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <h5 class="">39E4</h5> <span class="kl_title_info_event">contacts</span>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <h5 class="">494</h5> <span class="kl_title_info_event">mails envoyés</span>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <h5 class="">233</h5> <span class="kl_title_info_event">sms envoyés</span>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <h5 class="">400</h5> <span class="kl_title_info_event">publication facebook</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="">220</h5> <span class="kl_title_info_event">évenements</span>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <input type="text" name="key" class="form-control search" placeholder="Rechercher..." id="key">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <select name="clientType" class="form-control" id="clienttype"><option value="">Type</option><option value="person">Particulier</option><option value="corporation">Professionnel</option></select> <span class="help-block"><small></small></span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <input type="text" name="key" class="form-control search" placeholder="Periode" id="key">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <?php //echo $this->Form->control(null, ['type'=>'checkbox', 'label'=>'Filtres avancés', 'id'=>'is_affiche_filtre_avances']); ?>
                        <input type="checkbox" id="is_affiche_filtre_avances" >
                        <label class="kl_lien_filtres_avances">Filtres avancés</label>
                        <!--<a href="#" class="kl_lien_filtres_avances">Filtres avancés</a>-->
                        <a href="/event-selfizee-v2/evenements/add" class="btn btn-success kl_btn_refresh"> Filtrer</a>
                        <a href="/event-selfizee-v2/evenements/add" class="btn btn-success kl_btn_refresh"> Réinitialiser</a>
                    </div>
                </div>
                <div class="row filtre_avances hide">
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <input type="text" name="key" class="form-control search" placeholder="Rechercher..." id="key">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <select name="clientType" class="form-control" id="clienttype"><option value="">Type</option><option value="person">Particulier</option><option value="corporation">Professionnel</option></select> <span class="help-block"><small></small></span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <input type="text" name="key" class="form-control search" placeholder="Rechercher..." id="key">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <select name="clientType" class="form-control" id="clienttype"><option value="">Type</option><option value="person">Particulier</option><option value="corporation">Professionnel</option></select> <span class="help-block"><small></small></span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <input type="text" name="key" class="form-control search" placeholder="Rechercher..." id="key">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <select name="clientType" class="form-control" id="clienttype"><option value="">Type</option><option value="person">Particulier</option><option value="corporation">Professionnel</option></select> <span class="help-block"><small></small></span>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="font-size: 13px;">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col"><a href="/event-selfizee-v2/evenements?sort=Evenements.nom&amp;direction=asc">Nom</a></th>
                                <th scope="col"><a href="/event-selfizee-v2/evenements?sort=Evenements.client_id&amp;direction=asc">Client</a></th>
                                <th scope="col"><a href="#">Type</a></th>
                                <th scope="col"><a href="#">Ville</a></th>
                                <th scope="col"><a href="/event-selfizee-v2/evenements?sort=Evenements.date_debut&amp;direction=asc">Début</a></th>
                                <th scope="col"><a href="#">Email configuré</a></th>
                                <th scope="col"><a href="#">Sms configuré</a></th>
                                <th scope="col"><a href="#">Envoi auto</a></th>
                                <th scope="col"><a href="#">Facebook </a></th>
                                <th scope="col"><a href="#">Login galerie</a></th>
                                <th scope="col"><a class="desc" href="/event-selfizee-v2/evenements?sort=Evenements.id&amp;direction=asc">Identifiant</a></th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="red-tooltip" data-toggle="tooltip0" data-placement="right" data-html="true" title="" data-original-title="<img src='http://localhost/event-selfizee-v2/import/galleries/764/d2bf100b-87f0-4878-b3d8-659a27813d0a.jpg' width='50' />">
                                <td>
                                    <!--<div>
                                        <span class="mytooltip tooltip-effect-2">
                                    <i class="mdi mdi-information detail_event"><span class="tooltip-item"></span></i>
                                        <span class="tooltip-content clearfix">
                                        <span class="tooltip-text">Also known as Euclid of andria, was a Greek mathematician, often referred.</span>
                                        </span>
                                    </span>
                                    </div>-->

                                        <div data-toggle="tooltip" data-placement="right" data-html="true" title=""
                                             data-original-title="<div style='text-align:left';><span>Dernier upload photo : <br>Dernier upload data/csv : Dernier e-mail envoyé : <br>Dernier sms envoyé : <br>Dernier publication FB : </span></div>"
                                        >
                                            <i class="mdi mdi-information detail_event"></i>
                                        </div>
                                </td>
                                <td><div class="kl_nom_event">
                                        <a href="/event-selfizee-v2/evenements/view/764">CELL EVENT 2</a>
                                        <span class="kl_menu_context" class="btn btn-secondary" data-container="body" data-html="true" data-toggle="popover" data-placement="right"
                                              title="<div><img src='http://localhost/event-selfizee-v2/import/galleries/764/d2bf100b-87f0-4878-b3d8-659a27813d0a.jpg' width='50' />
                                              <span style='font-size:13px;'>Cell Event #1920</span></div>"
                                              data-content=
                                              '<div>
                                                <a class="dropdown-item" href="#"> <i class="mdi mdi-email"></i> Envoyer le galerie par mail</a>
                                                <a class="dropdown-item" href="#"> <i class="mdi mdi-image"></i> Visualiser la galerie</a>
                                                <a class="dropdown-item" href="#"> <i class="mdi mdi-chart-line"></i> Voir les stats</a>
                                                <a class="dropdown-item" href="#"> <i class="mdi mdi-file-image"></i> Voir les photos</a>
                                                <a class="dropdown-item" href="#"> <i class="mdi mdi-settings"></i> Configurer la borne</a>
                                                <a class="dropdown-item" href="#"> <i class="mdi mdi-delete"></i> Supprimer</a>
                                            </div>'
                                        >
                                            <i class="mdi mdi-menu-right"></i>
                                        </span>
                                </div>
                                </td>
                                <td>A CAPELLA</td>
                                <td>
                                    Pro                </td>
                                <td>Paris</td>
                                <td>
                                    04/11/2018                </td>
                                <td>Oui</td>
                                <td>Oui</td>
                                <td>Non</td>
                                <td>Non</td>

                                <td>
                                    CELL-EVENT                </td>
                                <td>764</td>
                                <!--<td>
                                    <form name="post_5bd024cf141ea799496197" style="display:none;" method="post" action="/event-selfizee-v2/evenements/delete/764"><input type="hidden" name="_method" value="POST" class="form-control"/></form><a href="#" onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.post_5bd024cf141ea799496197.submit(); } event.returnValue = false; return false;">Delete</a>                </td>-->
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="12">
                                    <div class="text-right">
                                        <ul class="pagination">
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>

<!--
</div>-->
