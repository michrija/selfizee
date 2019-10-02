datas_highcharts = JSON.parse($('#datas_highcharts_id').val());
console.log(datas_highcharts);
points = JSON.parse($('#datas_highcharts_points_id').val());
console.log(points);

/*$('.clockpicker').clockpicker({
    donetext: 'Done',
}).find('input').change(function() {
    console.log(this.value);
});*/


Highcharts.chart('container', {

  title: {
    text: ''
  },

  /*subtitle: {
    text: 'Source: thesolarfoundation.com'
  },*/

  xAxis: {
    categories: points
  },

  yAxis: {
    title: {
      text: ''
    }
  },

  legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

  plotOptions: {
    series: {
      label: {
        connectorAllowed: false
      },
      pointStart: 0//points['0']
    }
  },

  series: datas_highcharts/*[{
    name: 'Installation',
    data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 130000]
  }, {
    name: 'Manufacturing',
    data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
  }, {
    name: 'Sales & Distribution',
    data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
  }, {
    name: 'Project Development',
    data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
  }, {
    name: 'Other',
    data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
  }]*/,

  responsive: {
    rules: [{
      condition: {
        maxWidth: 500
      },
      chartOptions: {
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'bottom'
        }
      }
    }]
  }

});