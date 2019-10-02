<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <!--begin:: Global Mandatory Vendors -->
    <?= $this->Html->css([
        "login/login-v6.default.css",
        "perfect-scrollbar/css/perfect-scrollbar.css",
        "tether/dist/css/tether.css",
        "bootstrap-datepicker/dist/css/bootstrap-datepicker3.css",
        "bootstrap-datetime-picker/css/bootstrap-datetimepicker.css",
        "bootstrap-timepicker/css/bootstrap-timepicker.css",
        "bootstrap-daterangepicker/daterangepicker.css",
        "bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css",
        "bootstrap-select/dist/css/bootstrap-select.css",
        "bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css",
        "select2/dist/css/select2.css",
        "ion-rangeslider/css/ion.rangeSlider.css",
        "nouislider/distribute/nouislider.css",
        "owl.carousel/dist/assets/owl.carousel.css",
        "owl.carousel/dist/assets/owl.theme.default.css",
        "dropzone/dist/dropzone.css",
        "summernote/dist/summernote.css",
        "bootstrap-markdown/css/bootstrap-markdown.min.css",
        "animate.css/animate.css",
        "toastr/build/toastr.css",
        "morris.js/morris.css",
        "sweetalert2/dist/sweetalert2.css",
        "socicon/css/socicon.css",
        "line-awesome/css/line-awesome.css",
        "flaticon/flaticon.css",
        "flaticon2/flaticon.css",
        "fontawesome5/css/all.min.css",
        "demo/default/base/style.bundle.css",
        "demo/default/skins/header/base/light.css",
        "demo/default/skins/header/menu/light.css",
        "demo/default/skins/brand/dark.css",
        "demo/default/skins/aside/dark.css",
    ]); ?>

    <?= $this->Html->script([
           "jquery/dist/jquery.js",
           "popper.js/dist/umd/popper.js",
           "bootstrap/dist/js/bootstrap.min.js",
           "js-cookie/src/js.cookie.js",
           "moment/min/moment.min.js",
           "tooltip.js/dist/umd/tooltip.min.js",
           "perfect-scrollbar/dist/perfect-scrollbar.js",
           "sticky-js/dist/sticky.min.js",
           "wnumb/wNumb.js",
           "jquery-form/dist/jquery.form.min.js",
           "block-ui/jquery.blockUI.js",
           "bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
           "vendors/custom/components/vendors/bootstrap-datepicker/init.js",
           "bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js",
           "bootstrap-timepicker/js/bootstrap-timepicker.min.js",
           "vendors/custom/components/vendors/bootstrap-timepicker/init.js",
           "bootstrap-daterangepicker/daterangepicker.js",
           "bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js",
           "bootstrap-maxlength/src/bootstrap-maxlength.js",
           "vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js",
           "bootstrap-select/dist/js/bootstrap-select.js",
           "bootstrap-switch/dist/js/bootstrap-switch.js",
           "vendors/custom/components/vendors/bootstrap-switch/init.js",
           "select2/dist/js/select2.full.js",
           "ion-rangeslider/js/ion.rangeSlider.js",
           "typeahead.js/dist/typeahead.bundle.js",
           "handlebars/dist/handlebars.js",
           "inputmask/dist/jquery.inputmask.bundle.js",
           "inputmask/dist/inputmask/inputmask.date.extensions.js",
           "inputmask/dist/inputmask/inputmask.numeric.extensions.js",
           "nouislider/distribute/nouislider.js",
           "owl.carousel/dist/owl.carousel.js",
           "autosize/dist/autosize.js",
           "clipboard/dist/clipboard.min.js",
           "dropzone/dist/dropzone.js",
           "summernote/dist/summernote.js",
           "markdown/lib/markdown.js",
           "bootstrap-markdown/js/bootstrap-markdown.js",
           "vendors/custom/components/vendors/bootstrap-markdown/init.js",
           "bootstrap-notify/bootstrap-notify.min.js",
           "vendors/custom/components/vendors/bootstrap-notify/init.js",
           "jquery-validation/dist/jquery.validate.js",
           "jquery-validation/dist/additional-methods.js",
           "vendors/custom/components/vendors/jquery-validation/init.js",
           "toastr/build/toastr.min.js",
           "raphael/raphael.js",
           "morris.js/morris.js",
           "chart.js/dist/Chart.bundle.js",
           "vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js",
           "vendors/custom/vendors/jquery-idletimer/idle-timer.min.js",
           "waypoints/lib/jquery.waypoints.js",
           "counterup/jquery.counterup.js",
           "es6-promise-polyfill/promise.min.js",
           "sweetalert2/dist/sweetalert2.min.js",
           "vendors/custom/components/vendors/sweetalert2/init.js",
           "jquery.repeater/src/lib.js",
           "jquery.repeater/src/jquery.input.js",
           "jquery.repeater/src/repeater.js",
           "dompurify/dist/purify.js",
           "demo/default/base/scripts.bundle.js",
           "app/custom/login/login-general.js",
           "app/bundle/app.bundle.js",
           "https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js",
           "script.js",
    ]); ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
  <body  class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >
      <?= $this->fetch('content') ?>
   </body>
</html>
