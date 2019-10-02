<?php 
    echo $this->Html->css('plugins/bootstrap.min.css',['fullBase' => true]); 
    
?>

 <style>
 	 * {
 	 	color: #3e3e3e
 	 }

 	 body {
 	 	font-size: 1.32em !important;
 	 }

 	 .body {
 	 	margin: 0 30px !important
 	 }

 	 .detail-haut-2 {
 	 	line-height: 0.8 !important;
 	 }
 	 h3 {
 	 	font-size: 1.2em !important;
 	 }

 	 .large-height {
 	 	height: 300px !important;
 	 }


 	 .invoice-content table.table{
 	     border:1px solid #000;
 	   }
 	 .invoice-content table.table{
 	     border-top:1px solid #000;
 	   }
 	 .invoice-content table.table > thead > tr > th{
 	     /* border:1px solid #000; */
 	 }
 	 .invoice-content table.table > tbody > tr > td{
 	     /* border:1px solid #000; */
 	 }

 	 .table > tbody > .tr-inner > td {
 	 	line-height: 0.9 !important;
 	 	/* padding-top: 1px !important; */
 	 	padding-bottom: 2px !important;
 	 }


/*  	.invoice-content th, .invoice-content td {
 	 	border-color: #000 !important;
 	 } */
	
	#no-border td {
		border-color:#fff 
	}
 	 #border-top td {
 	 	border-top-color:#000 !important
 	 }
 	 #border-top-table td {
 	 	border-top: 1px solid #000;
 	 }
 	 #border-bottom-table td {
 	 	border-bottom: 1px solid #000;
 	 }
 	 #no-border-bottom td {
 	 	border-top-color:#FFF !important
 	 }
 	 #border-left td {
 	 	border-left:1px solid #000 !important
 	 }
 	 #no-border-top > td{
 	 	border-top-color: #fff !important
 	 }

 	 .lh-2 {
 	 	line-height: 2;
 	 }
 	 .to-xs-size {
 	 	font-size: 13.7px !important
 	 }
 </style>
<div class="container">
	<div class="body clearout-border-lg " >
		<div class="row mt-5 ml-1">
			<div class="col-xs-7">
				<h3><strong>Super U Rennes</strong></h3>
				<p class="clear-mg"><i>39 Rue de Molière</i></p>
				<p class="clear-mg"><i>35000 Rennes</i></p>
				
			</div>
			<div class="offset-xs-2 col-xs-3">
				<img style="margin-left: 80%" src="<?= WWW_ROOT.'img'.DS.'logo.png'?>" alt="">
				<!-- <h3 style="margin-left: 80%"><strong>Facture No. </strong></h3> -->
			</div>
		</div>
	
	<?= $this->fetch('content') ?>

<!-- 	<div class="lh-2 to-xs-size clearfix ">
	ANABEST SARL est immatriculée au registre du commerce Suisse sous le numéro : CHE-217.630.848 <br>
	
	
		<div class="row-fluid" >
			Pour les paiements en Euro : <br>
			Bénéficiaire : Anabest Sarl <br>
			IBAN : CH64 8046 0000 0540 8754 7 <br>
			BIC : RAIFCH22460 <br>
			Nom de la banque : Raiffeisen Morges Venoge – Rue du chêne 1 – 1315 La Sarraz <br>
		</div>

</div> -->
</div>
</div>
