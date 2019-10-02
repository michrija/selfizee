$(document).ready(function(){
    $('.input-daterange-datepicker').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY',
            applyLabel: 'Valider',
            cancelLabel: 'Annuler'
        },
        autoUpdateInput: false,
        /*startDate: new Date(),
        endDate: new Date(),*/
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-inverse'
    });

    $('.input-daterange-datepicker').on('apply.daterangepicker', function (ev, picker) {
        var dateDebut = picker.startDate.format('DD/MM/YYYY');
        var dateFin = picker.endDate.format('DD/MM/YYYY');
        $(this).val(dateDebut + ' - ' + dateFin);
        /*$('#datedebut').val(dateDebut);
        $('#datefin').val(dateFin);*/
    });

    $('.input-daterange-datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    
    $("#id_chekAll").change(function(){
        if($(this).is(":checked")){
            $(".kl_OneContact").attr("checked",true).prop('checked', true);
        }else{
            $(".kl_OneContact").attr("checked",false).prop('checked', false);
        }
        generateUrlToDelete();
    });
    
    
    $(".kl_OneContact").change(function(){
        generateUrlToDelete();
    });

    $("#id_filtreToActive").change(function(){
        if($(this).is(":checked")){
            $("#id_blocFormFiltre").removeClass('hide');
        }else{
            $("#id_blocFormFiltre").addClass('hide');
        }
    });
});

function generateUrlToDelete(){
    //alert('lelele');
    
    
    var idEvenement = $("#id_evenement").val();
    var baseUrl = $("#id_baseUrl").val();
    var urlDefaultAction = baseUrl+'contacts/deleteSelected/'+idEvenement+"/1";
    var list = "list[]=";
    var selected = 0;
    var allCheckBox = 0;
    $( ".kl_OneContact" ).each(function( index, value ) {
        allCheckBox++;
        if($(this).is(":checked")){
            list = list + '&list[]='+$(this).val();
            selected ++;
        }
    });
    var urlActionGenerated = urlDefaultAction + '?'+list;
    $("#id_contactSelected").find('form').attr('action', urlActionGenerated);
    
    if(selected >0){
        
        $("#id_contactSelected").removeClass('hide');
    }else{
        $("#id_contactSelected").addClass('hide');
    }
    
    if(allCheckBox == selected){ // Si tout est cheched
        $("#id_chekAll").attr("checked",true).prop('checked', true);
    }else{ // Si rien est cheched
        $("#id_chekAll").attr("checked",false).prop('checked', false);
    }
    
}