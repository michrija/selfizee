$(document ).ready(function() {
    
var nbrs = jQuery('#nbrs').val(); 
console.log(nbrs); 

var data =[];
var color = [ "#009efb", "#f62d51", "#55ce63", "#ffbc34", "#2f3d4a", '#f5f5f5', '#4f5467', '#7460ee'];


for(var i=0; i<nbrs; i++){
    if (jQuery("#systeme_"+i)!= null) {
        //latLng = [];
        var system = jQuery("#systeme_" + i).val();
        var user = jQuery("#user_" + i).val();
        var session = jQuery("#session_" + i).val();
        var pageview = jQuery("#pageview_" + i).val();

        var obj = new Object();

        obj.label = system;
        obj.value = parseFloat(pageview);
        obj.color = color[i] ;
        obj.highlight = color[i] ;
        data [i]  = obj;
    }
}

console.log(data);      
    
    var ctx3 = document.getElementById("chart3").getContext("2d");
    var data3 = data /*[
        {
            value: 300,
            color:"#009efb",
            highlight: "#009efb",
            label: "Blue"
        },
        {
            value: 50,
            color: "#edf1f5",
            highlight: "#edf1f5",
            label: "Light"
        },
		 {
            value: 50,
            color: "#2f3d4a",
            highlight: "#2f3d4a",
            label: "Dark"
        },
		 {
            value: 50,
            color: "#55ce63",
            highlight: "#55ce63",
            label: "Megna"
        },
        {
            value: 100,
            color: "#7460ee",
            highlight: "#7460ee",
            label: "Orange"
        }
    ]*/;
    
    var myPieChart = new Chart(ctx3).Pie(data3,{
        segmentShowStroke : true,
        segmentStrokeColor : "#fff",
        segmentStrokeWidth : 0,
        animationSteps : 100,
		tooltipCornerRadius: 0,
        animationEasing : "easeOutBounce",
        animateRotate : true,
        animateScale : false,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });
    
    
    
});