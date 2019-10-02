<?php use Cake\Routing\Router; ?>

<?= $this->Html->script('ConfigurationBornes/get_theme.js?'.time()); ?> 
<?= $this->Html->script('catalogues/detail.js?'.time()); ?>
<style>.hide{display:none;}</style>
<div class="ajax-text-and-image white-popup-block no-padding">
    <div class="col-sm-12 form-inline no-padding">
        <div class="col-sm-12 no-padding">
            <div class="sf-bloc-detail"  style="height: auto;background-image:none;">
            <?php $url_cadre = Router::url('/', true).'import/config_bornes/cadre_catalogue/'.$catalogueCadre->client_id.'/'.$catalogueCadre->file_name;?>
                <img src="<?php echo $url_cadre ?>" width="100%">
			</div>
        </div>
        <div class="clearfix"></div>
    </div>
    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
</div>
<script>
</script>