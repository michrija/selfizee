<div class="theSlide mx-auto w-75">
    <?php foreach($photos as $photo){ ?>
        <div class="wrapper">
        <div class="image-background" style="background:url('<?php echo  $photo->url_photo ?>')" ></div>
        </div>
    <?php } ?>
</div>