<?php $siteDescirption ='Manager Selfizee '; ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->Html->meta('favicon.png',["rel"=>"icon", "type"=>"image/png", "sizes"=>"16x16"]) ?>
    <title>
        <?= $this->fetch('title') ?> - <?= $siteDescirption ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    
    

    <!-- Bootstrap Core CSS -->
    <?= $this->Html->css('plugins/bootstrap.min.css') ?>
    <!-- Custom CSS -->
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Html->css('style2.css') ?>
    
    <!-- You can change the theme colors from here -->
    <?= $this->Html->css('colors/seflizee.css') ?>
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
<body class="fix-header fix-sidebar card-no-border">
        <?php use Cake\Routing\Router; ?>
        <input type="hidden" id="id_baseUrl" value="<?php echo Router::url('/', true) ; ?>"/>
        <?php //$this->element('preloader'); ?>
        <div id="main-wrapper">
            <?= $this->element('header'); ?>
            
      
            
            <div class="page-wrapper sansMenu">
                <div class="align-logo p-t-20">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <!-- Bread Crum -->
                        <div class="col-md-6 col-8 align-self-center">
                            <?= $this->fetch('breadcumb'); ?>
                        </div>
                        <!-- Page Tilte And Action -->
                        <div class="col-md-6 col-4 align-self-center">
                            <?= $this->fetch('actionTitle'); ?>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->

                    <!-- Content Page -->
                    <?php // $this->Flash->render() ?>
                    
                    <?= $this->fetch('content') ?>
                    

                </div>

                <?= $this->element('footer',['class'=>'footer-sane-menu']); ?>
        </div>
    </div>

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

    <?= $this->fetch('script') ?>

</body>
</html>