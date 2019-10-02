<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->Html->meta('favicon.png',["rel"=>"icon", "type"=>"image/png", "sizes"=>"16x16"]) ?>
    <title>Page introuvable</title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    
    

    <!-- Bootstrap Core CSS -->
    <?= $this->Html->css('plugins/bootstrap.min.css') ?>
    <!-- Custom CSS -->
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Html->css('style2.css') ?>
    
    <!-- You can change the theme colors from here --> 
    <?= $this->Html->css('colors/selfizee.css') ?>
    <?= $this->Html->css('sous-menu/dropdown.css') ?>
    <?= $this->Html->css('sous-menu/layout.css') ?>
    <?= $this->Html->css('sous-menu/utils.css') ?>
    <?= $this->fetch('css') ?>
    
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h2> ERROR 404  </h2>
                <h3 class="">Page introuvable</h3>
            <footer class="footer text-center"><?= $this->element('footer',['class'=>'footer']); ?></footer>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <?= $this->Html->script('jquery/jquery.min.js') ?>
    <!-- Bootstrap tether Core JavaScript -->
    <?= $this->Html->script('bootstrap/popper.min.js') ?>
    <?= $this->Html->script('bootstrap/bootstrap.min.js') ?>
    <!--Wave Effects -->
    <?= $this->Html->script('waves.js') ?>
</body>

</html>