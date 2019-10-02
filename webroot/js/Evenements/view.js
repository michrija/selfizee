//Flot Pie Chart
$(function () {
    var delivredRatio = $(".kl_delivredRatio").val();
    var ouvertRatio = $(".kl_ouvertRatio").val();
    var cliqueRatio = $(".kl_clickedRatio").val();
    var erreurRatio = $(".kl_bounceRatio").val();
    var dataEmail = [{
        label: "Délivrés"
        , data: delivredRatio
        , color: "#4f5467"
    , }, {
        label: "Ouvert"
        , data: ouvertRatio
        , color: "#55ce63"
    , }, {
        label: "Cliqué"
        , data: cliqueRatio
        , color: "#009efb"
    , }, {
        label: "Erreur"
        , data: erreurRatio
        , color: "#D33C44"
    , }];
    var plotObj = $.plot($("#flot-pie-chartSms"), dataEmail, {
        series: {
            pie: {
                innerRadius: 0.5
                , show: true
            }
        }
        , grid: {
            hoverable: true
        }
        , color: null
        , tooltip: true
        , tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20
                , y: 0
            }
            , defaultTheme: false
        }
    });
    
    var smsdelivredRatio = $('.kl_smsdelivredRatio').val();
    var smsnotdelivredRatio = $(".kl_smsNotdelivredRatio").val();
    
    //#flot-pie-chartEmail
      var dataSms = [{
        label: "Délivrés"
        , data: smsdelivredRatio
        , color: "#55ce63"
    , },
     {
        label: "Erreur"
        , data: smsnotdelivredRatio
        , color: "#D33C44"
    , }];
    var plotObj = $.plot($("#flot-pie-chartEmail"), dataSms, {
        series: {
            pie: {
                innerRadius: 0.5
                , show: true
            }
        }
        , grid: {
            hoverable: true
        }
        , color: null
        , tooltip: true
        , tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20
                , y: 0
            }
            , defaultTheme: false
        }
    });
});