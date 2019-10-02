<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    

    <?= $this->Html->css('plugins/bootstrap.min.css') ?>
    <?= $this->Html->css('slick/slick.css') ?>
    <?= $this->Html->css('slick/slick-theme.css') ?>
    <?= $this->Html->css('galerieSouvenir/diapo.css') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
   
            <?= $this->fetch('content') ?>
    
    <?=   $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js') ?>
    <?=   $this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js') ?>
    <?=   $this->Html->script('slick/slick.min.js') ?>
    <?=   $this->Html->script('galerieSouvenir/diapo.js') ?>
</body>
</html>