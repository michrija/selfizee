<?php $siteDescirption ='Manager Selfizee '; ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $siteDescirption ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <!-- Bootstrap Core CSS -->
    <?= $this->Html->css('plugins/bootstrap.min.css') ?>
    <!-- Custom CSS -->
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('users/login.css') ?>
     <?= $this->Html->css('custom.css') ?>
     <?= $this->Html->css('colors/selfizee.css') ?>
    
    <!-- You can change the theme colors from here -->
    <?= $this->Html->css('colors/purple.css') ?>
    <! font MONSTERRAT -->
    <?= $this->Html->css('font/Montserrat.css') ?>

    <?= $this->fetch('css') ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?= $this->element('preloader'); ?>
   
    <?= $this->fetch('content') ?>
    
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?= $this->Html->script('jquery/jquery.min.js') ?>
    <!-- Bootstrap tether Core JavaScript -->
    <?= $this->Html->script('bootstrap/popper.min.js') ?>
    <?= $this->Html->script('bootstrap/bootstrap.min.js') ?>
    <!-- slimscrollbar scrollbar JavaScript -->
     <?= $this->Html->script('jquery.slimscroll.js') ?>
    <!--Wave Effects -->
     <?= $this->Html->script('waves.js') ?>
    <!--Menu sidebar -->
     <?= $this->Html->script('sidebarmenu.js') ?>
    <!--stickey kit -->
     <?= $this->Html->script('sticky-kit-master/sticky-kit.min.js') ?>
    <!--Custom JavaScript -->
     <?= $this->Html->script('custom.min.js') ?>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
     <?= $this->Html->script('styleswitcher/jQuery.style.switcher.js') ?>

    <?= $this->Html->script('users/login.js') ?>
    
    <?= $this->fetch('script') ?>
</body>
</html>