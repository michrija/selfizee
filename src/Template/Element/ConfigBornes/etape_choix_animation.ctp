
<?php use Cake\Collection\Collection; ?>
<?php use Cake\Routing\Router; ?>
<div class="sf-step sf-step2 sf-choix-nb-animation hide config_animation">
    <div class="col-sm-12 m-b-15">
        <h5>Choix de votre animation :</h5>
    </div>
    <div class="row p-l-15 p-r-15">
        <?php	$type_animations_ids = [];
            if(!empty($configurationBorne->type_animations)) {
                $collection = new Collection($configurationBorne->type_animations);
                $type_animations_ids = $collection->extract('id');
                $type_animations_ids = $type_animations_ids->toList();
            }
        ?>
        <?php foreach($typeAnimations as $item_animation){ ?>
        <div class="col-md-4">
            <div class="card card-body sf-bg-animation sf-cursor <?php echo (in_array($item_animation['id'], $type_animations_ids) ? 'active' : '') ?>">
                <div class="row">
                    <div class="col-md-5 col-lg-5 text-center">
                        <figure class="text-center no-margin">
                            <img src="/img/confbornes/animations/<?php echo $item_animation['image_illustration']; ?>" alt="<?php echo $item_animation['description']; ?>" class="img-responsive">
                        </figure>
                    </div>
                    <div class="col-md-7 col-lg-7 no-padding-right bg-flex">
                        <div class="m-a">
                            <h5 class="box-title m-t-15 text-uppercase"><?php echo $item_animation['nom']; ?></h5>
                            <p><?php echo $item_animation['description']; ?></p>
                        </div>
                    </div>
                </div>
                <?php echo '<input type="checkbox" class="hide check_type_anim" name="type_animations[_ids][]" id="type_anim_'.$item_animation['id'].'" value="'.$item_animation['id'].'" '.(in_array($item_animation['id'], $type_animations_ids) ? 'checked="checked"' : '').'>'; ?>
            </div>
        </div>
        <?php }	?>
    </div>
</div>