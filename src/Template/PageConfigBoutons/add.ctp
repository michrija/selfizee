<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PageConfigBouton $pageConfigBouton
 */
?>
<?= $this->Html->script('dropify/dropify.min.js', ['block' => true]); ?>
<?= $this->Html->css('dropify/dropify.min.css',['block'=>true]) ?>

<!-- Color Picker Plugin JavaScript -->
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColor.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asGradient.js', ['block' => true]); ?>
<?= $this->Html->script('jquery-asColorPicker-master/jquery-asColorPicker.min.js', ['block' => true]); ?>
<?= $this->Html->script('PageConfig/page-config.js', ['block' => true]); ?>

<?= $this->Html->css('jquery-asColorPicker-master/asColorPicker.css',['block'=>true]) ?>

<?php
$titrePage = "Ajout bouton" ;
$this->assign('title', $titrePage);
$this->start('breadcumb');

echo $this->element('breadcrumb',['titrePage' => $titrePage]);
$this->end();
?>  


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Ajout bouton</h4>
				 <?= $this->Form->create($pageConfigBouton, ['type' => 'file', 'class' => 'col-md-6']) ?>
					<?php
						echo $this->Form->control('tag', ['label' => 'Nom du bouton']);
						echo $this->Form->control('fichier_tmp', ['type' => 'file', 'label' => 'Fichier', 'class' => 'form-control dropify', 'data-allowed-file-extensions' => 'png', 'accept' => '.png', 'required' => 'required']);
					 ?>
					<div class="text-xs-right">
						<a href="/page-config-boutons" class="btn btn-inverse">Return of list</a>						
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>

