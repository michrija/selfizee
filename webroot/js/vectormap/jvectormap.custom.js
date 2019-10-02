var val = jQuery('#latLng_id').val();
var nbrs = jQuery('#nbrs').val();

var markers =[];

for(var i=0; i<nbrs; i++){
    if (document.getElementById("lat_"+i)!= null && document.getElementById("lng_"+i)!= null) {
        //latLng = [];
        var lng = document.getElementById("lng_" + i).value;
        var lat = document.getElementById("lat_" + i).value;
        var pays = document.getElementById("pays_" + i).value;
        var ville = document.getElementById("ville_" + i).value;
        var session = document.getElementById("session_" + i).value;
        var pageview = document.getElementById("pageview_" + i).value;

        var position = new Object();
        latLng = [lat,lng];
        if(pays == "Madagascar"){
            latLng = [
            -18.9136800, 
            47.5361300
        ];
        }
        position.latLng = latLng;
        position.name = pays+" ("+ ville +"), Sessions :"+ session +", Pages vues :"+ pageview ;
        markers [i]  = position;
    }
}

console.log(markers);

jQuery('#world-map-markers').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    zoomOnScroll: true,
    color: '#ed185e7a',
    regionStyle : {
        initial : {
          fill : '#ed185e7a'//'#009efb'
        }
      },
    markerStyle: {
      initial: {
                    r: 5,//9
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 3,//5
                    'stroke-opacity': 0.4
                },
                },
    enableZoom: true,
    hoverColor: '#009efb',
    markers : markers,
    /*markers0 : [{
        latLng : [21.00, 78.00],
        name : 'I Love My India'      
      },{
        latLng : [48.8566,2.3522],#f2f4f8
        name : 'France'      
      }],*/
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: [],
    showTooltip: true,
    onRegionClick: function(element, code, region)
    {
        var message = 'You clicked "'
            + region
            + '" which has the code: '
            + code.toUpperCase();

        //alert(message);
    }
});