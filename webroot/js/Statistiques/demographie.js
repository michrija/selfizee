$(document).ready(function(){
	
	var objet = document.getElementById("chartAge");
	if(objet != null){
		var chartAge = objet.getContext("2d");
		var data3 = age;
		
		var myPieChart = new Chart(chartAge).Pie(data3,{
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
	}
});