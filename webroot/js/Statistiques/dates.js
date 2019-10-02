$(document).ready(function(){

	/*$('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });*/
	$('#heure_debut_filtre').clockpicker({
		//placement: 'top',
	    //align: 'left',
	    donetext: 'Ok',
		autoclose: true,
	    afterShow: function() {
	      //alert('TEST');
	      var choices = ["00","15","30","45"];
	      var mins = $(".clockpicker-minutes").find(".clockpicker-tick");
	      $.each(mins, function(index, elem){
	        var e = $(elem).text();
	        if(!($.inArray($(elem).text(), choices)!=-1)) {  
	          $(elem).remove();
	        console.log(e);
	        }
	      });
	    },
	    afterDone: function(){  // Keep the selected hour in memory.
		    selectedHour = $('#heure_debut_filtre').val();
		    heure = selectedHour.split(':')['0'];
		    minute = selectedHour.split(':')['1'];
		    heureValide = "";
		    if(parseInt(minute) < 15) {
		    	heureValide = heure+":00";
		    } else if( parseInt(minute) >= 15 && parseInt(minute) < 30) {
		    	heureValide = heure+":15";
		    }else if( parseInt(minute) >= 30 && parseInt(minute) < 45) {
		    	heureValide = heure+":30";		    	
		    } else if( parseInt(minute) >= 45 && parseInt(minute) < 60) {
		    	heureValide = heure+":45";
		    }
		    //alert(heureValide);
		    $('#heure_debut_filtre').val(heureValide);
		    console.log(heureValide);
  		}
	});

	$('#heure_fin_filtre').clockpicker({
		//placement: 'top',
	    //align: 'left',
	    donetext: 'Ok',
		autoclose: true,
	    afterShow: function() {
	      //alert('TEST');
	      var choices = ["00","15","30","45"];
	      var mins = $(".clockpicker-minutes").find(".clockpicker-tick");
	      $.each(mins, function(index, elem){
	        var e = $(elem).text();
	        if(!($.inArray($(elem).text(), choices)!=-1)) {  
	          $(elem).remove();
	          console.log(e);
	        }
	      });
	    },
	    afterDone: function(){  // Keep the selected hour in memory.
		    selectedHour = $('#heure_fin_filtre').val();
		    heure = selectedHour.split(':')['0'];
		    minute = selectedHour.split(':')['1'];
		    heureValide = "";
		    if(parseInt(minute) < 15) {
		    	heureValide = heure+":00";
		    } else if( parseInt(minute) >= 15 && parseInt(minute) < 30) {
		    	heureValide = heure+":15";
		    }else if( parseInt(minute) >= 30 && parseInt(minute) < 45) {
		    	heureValide = heure+":30";		    	
		    } else if( parseInt(minute) >= 45 && parseInt(minute) < 60) {
		    	heureValide = heure+":45";
		    }
		    $('#heure_fin_filtre').val(heureValide);
		    console.log(heureValide);
  		}
	});

	/*$('#date_debut_filtre').datetimepicker({
		//format: 'dd/mm/yyyy'
	});*/

	//$.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
	$('#date_debut_filtre').datepicker({
		language : 'fr-FR',
		format: 'dd/mm/yyyy',
		autoHide: true,
	    todayHighlight: true,
	    startDate: new Date($('#debut_event').val()),	    
	    endDate: new Date($('#end_event').val())
	});

	$('#date_fin_filtre').datepicker({
		language : 'fr-FR',
		format: 'dd/mm/yyyy',
		autoHide: true,
	    todayHighlight: true,
	    startDate: new Date($('#debut_event').val()),
	    endDate: new Date($('#end_event').val())
	});

});