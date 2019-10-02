
<?= $this->Html->css('politiques/pol.css?'.time(), ['block' => true]) ?>

<?php
	setlocale(LC_TIME, 'fr_FR.utf8','fra'); 
	$date_dernier_maj = $event_politique ? strftime("%d %B %Y", strtotime($event_politique['modified']->format('Y-m-d H:i:s'))) : '16 juillet 2019';
	$titre_intro = $event_politique ? 'Découvrez la politique liée au traitement des données utilisateurs'.(trim($event_politique['nom_client']) ? ' de '.trim($event_politique['nom_client']) : ' du fournisseur') : 'Découvrez en toute transparence la politique liée au traitement des données utilisateurs que nous collectons par le biais des animations effectuées au nom de nos clients organisateurs.';

?>

<div class="row kl_intro kl_introCssb">
	<div class="container">
         <div class="kl_theIntro">
            <p class="kl_fontWhite400Date">Dernière mise à jour : <?php echo $date_dernier_maj; ?></p>
         </div>
         <div class="kl_phrase_intro">
            <p class="kl_colorWhite">
				<?php echo $titre_intro; ?>
            </p>
         </div>
    </div>
</div>

<div class="sf-politique">
<div class="container">
<?php
	if($event_politique){
		echo $event_politique['contenu'];
	}else{
?>
		<p>SELFIZEE est une Marque  de  KONITYS (SAS au capital social  de  100 000€).</p>

		<p class="kl_text_align">Konitys  est une société française dont le siège est situé au 2 rue d’Armor à Plérin (22190). Comme nous prenons à cœur de respecter la vie privée de nos nombreux utilisateurs, nous mettons tout en œuvre pour respecter les lois en vigueur en matière de  protection  des données, et notamment le Règlement Général sur le Protection des Données (RGPD)
		</p>

		<p>Nous nous efforçons à ce que nos Clients en fassent autant lors de leur utilisation de la borne  photo SELFIZEE.</p>

		
		<div class="kl_table_des_matieres kl_titre">
			<!--<div class="kl_title">TABLES DES MATIERES</div-->
			<ul>
				<li><a href="#partie1" class="kl_paddingList sf-scroll-to">Que fait Selfizee des données collectées ?</a></li>
				<li><a href="#partie2" class="kl_paddingList sf-scroll-to">Selfizee traite les données à caractère personnel vous concernant suite à votre utilisation de la borne photo</a></li>
				<li><a href="#partie4" class="kl_paddingList sf-scroll-to">Pouvons-nous utiliser vos données?</a></li>
				<li><a href="#partie5" class="kl_paddingList sf-scroll-to">Qui a accès à vos données?</a></li>
				<li><a href="#partie7" class="kl_paddingList sf-scroll-to">Quels sont mes droits ?</a></li>
				<li><a href="#partie8" class="kl_paddingList sf-scroll-to">Où vos données sont-elles hébergées ?</a></li>
			</ul>
		</div>
		
		<h2 class="h2" id="partie1">QUE FAIT SELFIZEE DES DONNÉES COLLECTÉES ?</h2>

		<p class="kl_text_align">Depuis notre borne SELFIZEE, vous vous prenez en photo (ou vidéo, gif,...) en toute  autonomie.Nous vous envoyons celle-ci, via un lien vers une page souvenir, à l’adresse e-mail ou sur le numéro de portable que vous avez également renseigné  sur la  borne.  Nous  pouvons aussi poster  votre photo sur une galerie photo privée  qui est accessible  par notre Client. </p>

		<p class="kl_text_align">Celui-ci recevra également votre photo,  vos coordonnées (Email, téléphone portable),  mais  aussi les éventuelles réponses  que vous  avez  renseignées à notre client, lors  de  votre expérience  utilisateur depuis  la  borne photo.  Grâce à cela, vous  allez pouvoir recevoir  des informations  et/ou des promotions  de  la  part  de  notre Client. La  photo pourra  être  réutilisée  par notre client  à des fins  de  promotion,  par exemple en  la  publiant  sur ses réseaux sociaux ou  sur son site  internet.
		</p>

		<p class="kl_text_align">Sur  certaines animations, nous  utilisons un  algorithme  nous  permettant  d’obtenir différentes informations  complémentaires comme votre sexe, humeur, âge.  Ces informations  sont  disponibles pour  notre client  et  accessibles depuis  son manager.
		</p>

		<h2 class="h2" id="partie2">SELFIZEE TRAITE  LES DONNÉES À CARACTÈRE PERSONNEL VOUS  CONCERNANT  SUITE à VOTRE UTILISATION DE  LA  BORNE PHOTO :</h2>

		<p>
		<div>
		- La photo vous  représentant  ainsi que les autres  personnes apparaissant  avec  vous  sur celleci.
		</div><br>

		<div>
		- Votre adresse e-mail  et/ou votre numéro  de  téléphone mobile.
		</div><br>

		<div>
		- Vos réponses  aux questions requises  par notre client  (pouvant  inclure votre âge,  sexe, adresse postale,  etc.)
		</div><br>

		<div class="kl_text_align">
		- Plus  globalement,  les informations  issues  de  notre algorithme  : votre sexe  (féminin, masculin, non défini),  votre humeur  (négative,  neutre, positive),  votre look  (effrayé  – fâché – dégouté –content – triste  – surpris), votre âge (de 0 à 4 ans,  ensuite tous  les 5 ans jusqu’à +60 ans)
		</div> 
		</p>

		<h2 class="h2" id="partie3">Ces données collectées sont utiles pour : </h2>

		<div>
		- Vous envoyer votre photo par e-mail  et/ou SMS.
		</div><br>

		<div>
		- Publier votre photo dans  la galerie  privée  de  l’événement.
		</div><br>

		<div class="kl_text_align">
		- Transférer  votre photo à notre client  ainsi que vos réponses  aux questions posées  sur les écrans  de  la  borne photo,  qui lui permettent  de  mieux vous  connaître.  Il  pourra  utiliser  votre photo et  vos données à des fins  de  communication et  de  marketing,  sur tous  supports  de son choix,  s’il  en  a fait  mention dans  les écrans  de  la  borne photo.  Libre à vous  d’accepter  ou  de  refuser ces conditions. Notre client  pourra  vous  envoyer des offres  promotionnelles via le  canal de  communication qu’il souhaitera.
		</div>

		<h2 class="h2" id="partie4">POUVONS-NOUS UTILISER VOS DONNÉES ? </h2>

		<p class="kl_text_align">Le contrat avec  notre client  nous  permet  de  vous  offrir, en  son nom,  la  photo gratuitement  
		(imprimée ou  non). En  effet celui-ci  paye  pour  cette prestation. Nous  avons donc  un  intérêt 
		évident de collecter  en  contrepartie  vos données à caractère personnel et  de  les divulguer à 
		notre client. Nous  demanderons toujours  votre consentement  préalable si  notre Client  souhaite  utiliser  vos données à caractère personnel en  vue de  vous  proposer  ses offres  promotionnelles ou  s’il  
		souhaite  publier votre photo en  ligne.  Afin  que cela  soit  mis en  place sur les écrans  de  la  borne photo,  notre Client  devra nous  fournir les textes  lors  de  la  configuration de  l’événement.  
		Nous  demanderons votre consentement  libre, préalable  et  informé dans  le  cas où  notre Client  souhaite  utiliser  vos données à caractère personnel à des fins  de  marketing direct  ou  publier votre photo (sur  leurs comptes de  réseaux sociaux ou  sur leur  site) ou  les utiliser  pour  des communications  d’entreprise  internes  ou  externes. Par votre consentement  sur l’écran,  vous  renoncez  irrévocablement à toute réclamation de  compensation  (économique)  pour  l’utilisation de  votre photo par notre client.
		</p>

		<h2 class="h2" id="partie5">QUI A ACCÈS À VOS DONNÉES ?</h2>

		<p class="kl_text_align">Notre  client, organisateur  de  l’événement,  a accès à votre photo ainsi qu’à  votre adresse e- mail et  à votre numéro  de  portable. L’équipe  technique SELFIZEE  ainsi que notre équipe  de  chargés de  projets peuvent également avoir accès à vos données à caractère personnel.  Cela  est valable aussi pour  vos éventuelles réponses  aux questions demandées par notre client  sur les écrans  de  la  borne photo,  ainsi qu’aux informations  issues  de  notre algorithme. 
		</p>

		<h2 class="h2" id="partie6">Le cas échéant, les destinataires suivants peuvent avoir accés à vos données :</h2>		

		<p>
		<div class="kl_text_align">
		- Les  équipes techniques, les chargés de  projets,  les conseillers commerciaux et  les directeurs  de  la  SAS KONITYS. Selfizee – Politique de  Traitement  des Données
		</div>

		<div class="kl_text_align">
		- Les prestataires  de  services  tiers liés  à la  maintenance des systèmes  informatiques chargés du  traitement  de  vos données à caractère personnel (ces  prestataires  ont uniquement  accès aux données à caractère personnel nécessaires à l’exécution de  leurs tâches)
		</div>

		<div>
		- Les tribunaux de  l’ordre judiciaire  en  cas de  litige  vous  concernant.
		</div>

		<div class="kl_text_align">
		- Les autorités chargées  de  l’application de  la  loi dans  le  cas d’un  constat ou  d’une suspicion de  délit vous  concernant  tel que prévu par la  loi applicable.- Dans le  cas d’une fusion  ou  d’une acquisition de  SELFIZEE, nous  transférerons vos données à caractère personnel à un  tiers impliqué  dans  la  transaction (ex.  un  acheteur) conformément  à la  loi relative  à la  protection  des 
		données applicable.
		</div>
		<div class="kl_text_align">
		Nous  prenons des mesures appropriées pour  assurer que nos serveurs  de  données (y  compris notre fournisseur tiers d’infrastructure  cloud)  traitent  vos données à caractère personnel conformément  à la  loi relative  à la  protection  de  données applicable.
		</div>
		</p>

		<h2 class="h2" id="partie7">QUELS  SONT  MES DROITS  ? </h2>

		<p class="kl_text_align">
		Vous disposez  du  droit de  savoir  comment nous  utilisons vos données à caractère personnel et  comment exercer vos droits. Si  vous  souhaitez obtenir plus  d’informations, envoyez-nous  un  email à l’adresse suivante  : <a href="mailto:dpo@konitys.fr" class="kl_link">dpo@konitys.fr</a>.
		</p>

		<p>
		Vous  disposez  du  droit d’accéder à vos données à caractère personnel que nous  possédons à votre sujet.
		</p>

		<p class="kl_text_align">
		Vous  disposez  du  droit de  demander  la  suppression de  vos données à caractère personnel s’il  n’existe  pas de  raison  impérieuse  pour  nous  de  continuer à les utiliser. Veuillez  noter que le  droit d’effacement  n’est pas un  droit absolu  et  que des exceptions  s’appliquent. Vous  pouvez  exercer quelconque  de  vos droits  en  envoyant  une demande à <a href="mailto:dpo@konitys.fr" class="kl_link">dpo@konitys.fr</a>.
		</p>

		<p>
		En  vertu des lois  relatives à la  protection  des données,  vous  disposez  du  droit d’accéder,  rectifier et  effacer vos données à caractère personnel,  le  droit de  vous  opposer ou  de  limiter le  traitement  de  vos données à caractère personnel ainsi que le  droit de  portabilité des données,  ce  qui signifie  que :
		</p>

		<div class="kl_text_align">
		- Vous  disposez  du  droit de  recevoir  une information claire, transparente  et  aisément  compréhensible  sur la  manière dont  nous  utilisons vos données à caractère personnel et  vos droits.
		</div>

		<div class="kl_text_align">
		- Vous  disposez  du  droit d’obtenir l’accès à vos données à caractère personnel,  de  manière à comprendre  et  pouvoir contrôler que nous  utilisons vos données à caractère personnel conformément  aux lois  applicables en  matière de  protection  des données.
		</div>

		<div class="kl_text_align">
		- Vous  disposez  du  droit de  faire rectifier vos données à caractère personnel si  celles-ci sont  inexactes ou  incomplètes.
		</div>

		<div class="kl_text_align">
		- Vous  avez  le  « droit d’être  oublié  ».  Vous  pouvez  donc  demander  la  suppression de  vos données à caractère personnel lorsqu’il n’y a pas de  raison  pour  nous  de  continuer à les utiliser. 
		Le  droit d’effacement  ne  constitue pas un  droit absolu  et  des exceptions  s’appliquent.
		</div>

		<div class="kl_text_align">
		- Après  nous  avoir octroyé votre consentement  pour  quelconque  de  nos activités de  traitement  de  vos données à caractère personnel,  vous  disposez  du  droit,  en  tout  moment, de  retirer votre consentement  (le cas échéant,  cela  ne  signifie  pas que le  traitement  de  vos données à caractère personnel réalisé jusqu’à cette date  sous  votre consentement  soit  illégal).Pour cela  nous  vous  permettons  d’accéder à votre espace  personnel à l’adresse suivante : <a href="<?php echo $domaine; ?>" class="kl_link"><?php echo $domaine; ?></a>
		</div>

		<p class="kl_text_align">
		A noter que nous  pourrions retenir certaines de  vos données à caractère personnel à certaines fins  requises  ou  autorisées  par la  loi.  En  cas de  doute à propos  de  votre identité, nous  vous  demanderons une preuve  d’identité.
		</p>

		<p class="kl_text_align">
		Si  vous  souhaitez ne  plus  recevoir  d’e-mail  marketing de  notre Client, il  vous  est normalement possible  de  vous  désinscrire,  en  tout  moment, de  sa  liste de  diffusion (via  le  lien  de  désinscription  qu’il doit  afficher  en  bas de  ses email et  SMS marketing). Le  cas échéant,  envoyez lui un  email.
		</p>

		<p class="kl_text_align">
		Si  vous  ne  pouvez  pas exercer votre droit d’objecter  ou  si  vous  continuez à recevoir  des communications  marketing après avoir exercé  votre droit d’objecter, veuillez  nous  contacter à l’adresse e-mail  suivante  : <a href="mailto:dpo@selfizee.fr" class="kl_link">dpo@selfizee.fr</a>,  nous  ferons  alors tout  notre possible  pour  faire 
		entendre  votre voix  auprès  de  notre Client. Cependant la  SAS KONITYS ne  pourra  être  responsable des agissements de  notre Client.
		</p>

		<h2 class="h2" id="partie8">OÙ VOS DONNÉES SONT-ELLES  HÉBERGÉES ? </h2>

		<p class="kl_text_align">Vos  données sont  stockées  dans  des serveurs  dédiés  uniquement  à l’intérieur de  l’UE, nous  ne  transférons pas vos données à caractère personnel à des pays  situés  en-dehors de  l’UE. Nous  conservons  vos données à caractère personnel aussi longtemps que nécessaire  afin  d’assurer le bon traitement  de  celles-ci.
		</p>

		<p class="kl_text_align">
		Nous  adoptons  des mesures techniques  et  organisationnelles  en  vue d’assurer un  niveau  de  sécurité  adéquat pour  vos données à caractère personnel.  Par exemple,  nous  prenons des mesures appropriées afin  de  nous  assurer de  rapporter tout  incident  de  sécurité  donnant lieu  à la  destruction,  perte,  modification, divulgation non autorisée ou  accès aux données à caractère personnel illégal ou  accidentel. 
		</p>

		<p class="kl_text_align">
		Nous  pouvons modifier  la  manière dont  nous  collectons  et  utilisons vos données à caractère personnel.  Le  cas échéant,  nous  vous  informerons de  toute modification.Notre  politique de  confidentialité pourra  être  modifiée  à tout  moment. Veuillez  donc  la  réviser régulièrement.  Nous  vous  informerons de  toute modification  apportée  à notre politique de  confidentialité de  manière à ce  que vous  soyez informé en  tout  moment  de  la  manière dont  nous  traitons  vos données à caractère personnel.
		</p>

		<p class="kl_text_align">En  cas de  conflit ou  d’inconsistance entre une disposition de  la  présente  politique de  confidentialité et  une disposition d’une autre politique ou  d’un  autre document  de  SELFIZEE relatif  au  traitement  des données à caractère personnel,  les dispositions  de  la  présente politique prévaudront.
		</p>

	<?php } ?>
</div>
</div>
<br>