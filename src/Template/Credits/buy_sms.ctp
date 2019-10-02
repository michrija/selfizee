

<?= $this->Html->script('select2/select2.full.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/jquery.steps.min.js', ['block' => true]); ?>
<?= $this->Html->script('wizard/jquery.validate.min.js', ['block' => true]); ?>
<?= $this->Html->script('jquery.stringtoslug/jquery.stringtoslug.min.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-daterangepicker/daterangepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => true]); ?>
<?= $this->Html->script('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js', ['block' => true]); ?>
<?= $this->Html->css('evenements/add.css?t='.time(), ['block' => true]) ?>
<?= $this->Html->script('Credits/add.js', ['block' => true]); ?>
<script src="https://js.stripe.com/v3/"></script>
<style>
        /**
     * The CSS shown here will not be introduced in the Quickstart guide, but shows
     * how you can use CSS to style your Element's container.
     */
    .StripeElement {
      box-sizing: border-box;

      height: 40px;

      padding: 10px 12px;

      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;

      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
</style>



<?php
$titrePage = "";
$this->assign('title', $titrePage);
$this->start('breadcumb');
$this->Breadcrumbs->add(
'Dashboards',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add(
'Evénements',
['controller' => 'Evenements', 'action' => 'index']
);

$this->Breadcrumbs->add($titrePage);

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();

?>


<style>
    div.active-price .card-footer { background-color: rgb(255, 104, 131)!important;}
    div.active-price .styled-hr { background-color: #FFF!important;}
    .active-price h1, .active-price h2, .active-price h3, .active-price .card-footer .fa { color: #FFF }
    .card-footer { font-size: 1.8em;}
    .price-box { cursor: pointer; }
    .styled-hr {
        width: 20%;
        height: 1px;
        margin: 0.5em auto;
        background-color: #929292
    }
    .price-box h1 {
        font-size: 1.8em
    }
    .wizard-content .wizard>.steps>ul>li:after {
    right: 0;
    left: 126%;
    }
    .price{
        width: 80px;
    }
    .editer{
        color: #ea2161;
    }
    .pay{
      margin-left: 30%;
      margin-top: 20%;
    }
    .validers{
      margin-left: 22%;
      margin-top: 5%;
    }   
 
   
</style>

 <!-- vertical wizard -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content " id="id_creationEvenement">
                <?= $this->Form->create(false,['url' => ['action' => 'validate-paiment',$eventId,$client_id],'class' => 'tab-wizard form-bordered','id'=>'payment-form']) ?>

                    <input autocomplete="off" name="hidden" type="text" style="display:none;">

                    <!-- Step 1 -->
                    <h6>Choix du pack </h6>
                    <section>
                            <?php
                            $myTemplates = [
                                'dateWidget' => '<div class="col-md-6">{{day}}{{month}}{{year}} <span class="seperate">-</span> {{hour}} h {{minute}}{{second}}{{meridian}}</div>',
                                    'select' => '<div class="col-6"><select name="{{name}}"{{attrs}} class="form-control nowidth" >{{content}}</select></div>',
                                    'label' => '<label{{attrs}} class="control-label kl_labelCustomMonsterat col-3">{{text}}</label>',
                                    'inputContainer' => '<div class="form-group row">{{content}} <span class="help-block"><small>{{help}}</small></span></div>',
                                    'input' => '<div class="col-12"> <input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/></div>',
                                    'inputContainerError' => '<div class="form-group row has-danger {{type}}{{required}} error">{{content}}{{error}}</div>',
                                    'error' => '<div class="form-control-feedback my-auto">{{content}}</div>',
                            ];
                            
                            $this->Form->setTemplates($myTemplates); 
                            ?>
                            <div class="form-body">
                                <div class="row">
                                    <?php foreach ($smsPrices as $key => $sms): ?>
                                        
                                    <div class="col-lg-3 col-sm-6 text-center my-auto" >
                                        <div class="card border <?= $key == 0 ? "bg-danger active-price": "" ?> price-box" data-id="<?= $sms->id ?>" data-sms="<?= $sms->nbr_sms ?>" data-price="<?= $sms->prix ?>">
                                            <div class="card-body py-5">
                                                <div class="pt-3">
                                                    <h1 class="mb-3 " > <b><?= $sms->nbr_sms ?> SMS</b> </h1>
                                                    <div class="styled-hr"></div>
                                                    <h2 class="mt-3" > <b><?= $sms->prix ?> € HT</b> </h2>
                                                    <h3 class=""> <b><?= $sms->get('priceTTC') ?> € TTC</b> </h3>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <span class="fa fa-check d-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                     <?= $this->Form->hidden('sms_tarif_id', ['class' => 'check-data-id']); ?>
                                </div>
                            </div>
                        
                    </section>
                    <!-- Step 2 -->
                    <h6> Récap </h6>
                        <section>
                            <div class="row">
                            <div class="col-lg-7 col-xlg-7 col-md-7">
                            <h3>Détail</h3>
                            <?php //debug($data); ?>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th width="85%"><b>Déscription</b></th>
                                      <th width="15% " ><b>Prix Total</b></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td><span>Pack </span> <span class="sms"></span> sms prémium </td>

                                      <td class="pl-2"><span class="price"></span></td>
                                    </tr>
                                  </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2"><a href="" class="editer" onclick='return false;'>Modifier</a></div>
                            </div>
                             <table class="table">
                                  <thead>
                                    <tr>
                                      <th width="65%"></th>
                                      <th width="20%" ></th>
                                      <th width="15%" ></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td></td>
                                      <td class="pull-right">montant TH</td>
                                      <td class="montant"> </td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td class=" pull-right">TVA 20%</td>
                                      <td class="tva"> </td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td class="pull-right">Montant Total </td>
                                      <td class="total"></td>
                                    </tr>
                                  </tbody>
                            </table>
                           
                            </div>
                            <div class="col-lg-5 col-xlg-5 col-md-5">
                              <h3>Données de Facturation</h3>  
                             <div class="mt-4">
                              <h6 class="adressName">Super U Rennes</h6>
                              <p class="adressCode">39 Rue de Molière </p>
                              <p class="adresscp"> 35000 Rennes </p>
                              <textarea class="adresseText mb-3 pb-3 form-control d-none" style="width: 100%"> </textarea>
                             </div>
                             <a href="" class="editAdress" onclick='return false;'>Modifier l'adresse de la facturation</a>
                             <div class="mt-4">
                                 <h3>Paiement</h3>
                             </div> 
                             <hr>
                                <ul class="sf-list-pers">
                                <li class="p-30 p-l-50">
                                    <label class="custom-control custom-radio no-margin" for="mep_cadre_catalogue">
                                        <input type="radio" name="type_mise_en_page_id" id="mep_cadre_catalogue" value="1" class="custom-control-input" checked >
                                        <span class="custom-control-label m-l-20">Carte bancaire (créditation de votre compte immédiate)</span>
                                    </label>
                                </li> 
                                <li class="p-30 p-l-50">
                                    <label class="custom-control custom-radio no-margin" for="mep_cadre_1">
                                        <input type="radio" name="type_mise_en_page_id" id="mep_cadre_1" value="2" class="custom-control-input"  >
                                        <span class="custom-control-label m-l-20">Virement bancaire</span>
                                    </label>
                                </li>

                                <li class="p-30 p-l-50">
                                    <label class="custom-control custom-radio no-margin" for="mep_cadre_3">
                                        <input type="radio" name="type_mise_en_page_id" id="mep_cadre_3" value="3" class="custom-control-input"  >
                                        <span class="custom-control-label m-l-20">Chèque</span>
                                    </label>
                                </li>
                            </ul>  
                            </div>
                        </div>
                        </section>
                    <h6 class="payement"> Paiement </h6>
                        <section class="payement">
                          <div class="cb d-none">
                              <h3>Règlement par Carte Bancaire</h3>
                              <div class="row m-t-50 ">
                                 <div class="col-md-4 ">
                                      <a href="<?= $this->Url->build(['controller' => 'Credits', 'action' => 'stripe']) ?>" class="btn btn-danger pay pr-5 pl-5">PAYER EN LIGNE</a>
                                 </div>
                                <div class="col-md-8">
                                      <img src="<?= $this->Url->build('/img/stripe.png') ?>"/>
                                 </div>
                              </div>
                          </div>
                            <div class="cheque d-none">
                                <h4 class="m-b-0 text-black pull-left">Règlement par Chèque </h4>
                                <div class="clearfix mb-5"></div>
                                 <p>Pour régler votre commande , veuillez nous faire parvenir votre chèque rempli rempli à l'adresse suivante :</p>
                  
                                  <div class="contents m-t-100 m-l-50">
                                    <p><b>Konitys SAS</b></p>
                                    <p><b>2 Place Konard Adenauer ,22190 Plérin</b></p>
                                    <p><b>Montant 60 € TTC</b></p>
                                    <p><b>Reference à faire apparaitre imperativement au dos du chèque : #SMS1909021</b></p>
                                  </div>
                          </div>
                            <div class="virement d-none ">
                                <h4 class="m-b-0 text-black pull-left">Règlement par Virement </h4>
                                <div class="clearfix mb-5"></div>
                                 <p>Pour régler votre commande , veuillez effectuer votre virement sur le compte suivante:</p>
                  
                                  <div class="contents m-t-100 m-l-50">
                                    <p class="mb-3"><b>INFOS RIB</b></p>
                                    <p><b>Montant 60 € TTC</b></p>
                                    <p><b>Reference à faire apparaitre imperativement au dos du chèque : #SMS1909021</b></p>
                                  </div>
                          </div>
                
              
                        </section>
                    <h6 class="Confirmation"> Confirmation </h6>
                        <section >
                            <div class="row Confirmation d-none">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                             <p>Cliquer sur Términer pour rédiriger vers la page de paiement
                                              <a href="<?= $this->Url->build(['controller' => 'Credits', 'action' => 'stripe']) ?>" class="valider d-none pr-5 pl-5">PAYER EN LIGNE</a>
                                             </p>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="message d-none ">
                              <h3 class="validers">
                               Cliquer sur Términer pour valider votre achat Sms
                              </h3>
                            </div>
                        </section>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<input type="hidden" value="<?= $campagne?>" class="campagne">
<a href=" <?= $this->Url->build(['controller' => 'Credits', 'action' => 'addPriceWithSms']) ?>" class="url d-none"></a>
<!-- ============================================================== -->

