<script src="https://js.stripe.com/v3/"></script>
<?= $this->Html->script('Credits/stripe.js', ['block' => true]); ?>
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


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
		      <div class="row">
		      	<div class="col-md-6"></div>
		      	<div class="col-md-6 pr-5 pl-5">
					<div class="container">
				 <?= $this->Form->create(false, ['url' => ['action' => 'validate-paiment'], 'class' => 'form-vertical', 'id' => 'payment-form']); ?>
					 <div class="mt-4">
					 	<div id="card-element">
					 		<?php  echo $this->Form->control('email',['label'=>"E-mail *",'type'=>'email','required'=>true, ]); ?>
					 		<?php  echo $this->Form->control('number',['label'=>"Informations de la carte *",'required'=>true, ]); ?>
					 		<div class="row">
					 			<div class="col-md-6">
					 			   <div class="row">
					 				 <div class="col-md-6">
					 				    <?php  echo $this->Form->control('exp_month',['label'=>false,'required'=>true,'placeholder'=>"MM",'data-stripe'=>'exp_month' ]); ?>
					 				 </div>	
					 				 <div class="col-md-6">
					 				    <?php  echo $this->Form->control('exp_year',['label'=>false,'required'=>true,'placeholder'=>"YY",'data-stripe'=>'exp_year']); ?>
					 				 </div>	
					 			   </div>
					 			</div>
					 			<div class="col-md-6">
					 				<?php  echo $this->Form->control('cvc',['label'=>false,'required'=>true,'placeholder'=>"CVC" ,'data-stripe'=>'cvc']); ?>
					 			</div>
					 		</div>
					 		<?php  echo $this->Form->control('name',['label'=>"Nom du titulaire de la carte *",'required'=>true, ]); ?>
					 	</div>
					 </div>
					 <!-- Used to display Element errors. -->
					 <div class="form-group">
						<?= $this->Form->button('Soummettre', ['class' => ' button','style'=>'width:100%']); ?>
					 </div>
				 </div>
				<?= $this->form->end() ?>
		      	</div>
		      </div>
			</div>
		</div>
	</div>
</div>
