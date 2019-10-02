var nbrs = jQuery('#nbrs').val(); 
var nbrs_total_source = jQuery('#nbrs_total_source').val();

var data =[];
var canaux =[];// item
var color = [  "#55ce63", "#ffbc34", "#f62d51", "#009efb", "#2f3d4a"];
var color_utilise = [];


for(var i=0; i<nbrs_total_source; i++){
    var canal = document.getElementById("canaux_" + i).value;
    if(canal == "(direct)") canal = "Direct";
    canaux [i] = canal;
}

for(var i=0; i<nbrs; i++){
    if (document.getElementById("source_"+i)!= null && document.getElementById("session_"+i)!= null) {
        //latLng = [];
        var source = document.getElementById("source_" + i).value;
        var session = document.getElementById("session_" + i).value;
        var pageview = document.getElementById("pageview_" + i).value;
        if(source == "(direct)") source = "Direct";

        var obj = new Object();

        obj.value = pageview;
        obj.name = source ;
        color_utilise [i] = color[i];
        data [i]  = obj;
    }
}

console.log(data);

// ============================================================== 
// doughnut chart option
// ============================================================== 
var doughnutChart = echarts.init(document.getElementById('doughnut-chart'));

// specify chart configuration item and data

option = {
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data: canaux/*['Item A','Item B','Item C','Item D','Item E']*/
    },
    toolbox: {
        show : true,
        feature : {
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'center',
                        max: 1548
                    }
                }
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: color_utilise/*["#f62d51", "#009efb", "#55ce63", "#ffbc34", "#2f3d4a"]*/,
    calculable : true,
    series : [
        {
            name:'Source',
            type:'pie',
            radius : ['80%', '90%'],
            itemStyle : {
                normal : {
                    label : {
                        show : false
                    },
                    labelLine : {
                        show : false
                    }
                },
                emphasis : {
                    label : {
                        show : true,
                        position : 'center',
                        textStyle : {
                            fontSize : '30',
                            fontWeight : 'bold'
                        }
                    }
                }
            },
            data: data/*[
                {value:335, name:'Item A'},
                {value:310, name:'Item B'},
                {value:234, name:'Item C'},
                {value:135, name:'Item D'},
                {value:1548, name:'Item E'}
            ]*/
        }
    ]
};
                                    
                    

// use configuration item and data specified to show chart
doughnutChart.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    doughnutChart.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });