var baseUrl ;
$(document).ready(function(){
     baseUrl = $("#id_baseUrl").val();

    var tabs = $('.tab_step_list li a');
    var links = [];
    console.log(tabs.length);
    $.each(tabs, function (index, elem) {
        var tab = $(elem);    
        //links.push(tab.attr('href'));
        links[tab.attr('href')] = index;
    });
    //console.log(links);

    var currentIndex = 0;
    var lastIndex = 0;
    // etape first
    $('#prevBtn').attr('disabled', true);    
    tab_active = tabs[currentIndex];
    link = $(tab_active).attr('href');
    link = link.substring(1,link.length); // enlever le #
    $('.saveStep').attr('data-owner', link );
    $('.saveStep').attr('data-step', currentIndex);//+ 1

    /**
    * Gestion pagination
    */
    $('.nextPrev').click(function() {
        var n = $(this).attr('data-owner');
        n = parseInt(n);
        lastIndex = currentIndex;
        currentIndex = currentIndex + n;
        
        
        onStepChanging (currentIndex, lastIndex);

        //== Affichage tab
        tab_active = tabs[currentIndex];
        tab_active.click();
        link = $(tab_active).attr('href');
        link = link.substring(1,link.length); // enlever le #
        $('.saveStep').attr('data-owner', link );
        $('.saveStep').attr('data-step', currentIndex);//+ 1
        

    });

    

    function onStepChanging (currentIndex, lastIndex){
        if(currentIndex == 0){            
            $('#prevBtn').attr('disabled', true);
        } else {
            $('#prevBtn').attr('disabled', false);
        }   

        if(currentIndex >= tabs.length - 1){ 
            $('#nextBtn').attr('disabled', true);
            $('#btnSaveAndNext').addClass('hide');
        } else {
            $('#nextBtn').attr('disabled', false); 
            $('#btnSaveAndNext').removeClass('hide');           
        }

        //====    
        console.log(lastIndex) ;   
        type_mise_en_page = $('input[type=radio][name=type_mise_en_page_id]:checked').val();
        if(currentIndex == 1){            
            //alert(type_mise_en_page);
            if(type_mise_en_page == undefined ){
                alert("Vous devez choisir une mise en page");
                tabs[lastIndex].click();
                return ;
            }
        }
        
        //url
        window.location.hash = "step"+(currentIndex+1);
    }

    $('.tab_step_list li a').click(function() {
        var link = $(this).attr('href');
        lastIndex = currentIndex;
        currentIndex = links[link];
        
        $('.saveStep').attr('data-owner', link.substring(1,link.length));
        $('.saveStep').attr('data-step', currentIndex);//+ 1

        onStepChanging (currentIndex, lastIndex);        
    });

    /*
    *  
    */
    $('.saveStep').click(function() {
        var formStep = $('.tab_step_content .active form')[0];
        formStep = new FormData( formStep );
        var formData =  $('.tab_step_content .active form').serializeArray();
        console.log(formData);

        //test 
        $(this).find('i.fa-spin').removeClass('hide');
        $('.saveStep').attr('disabled', true);
        var this_id = $(this).attr('id');
        currentIndex =  parseInt($(this).attr('data-step'));
        setTimeout(function () {  
            $('.saveStep').find('i.fa-spin').addClass('hide');
            $('.saveStep').attr('disabled', false);
            if( this_id == "btnSaveAndNext" ){
                next_tab = tabs[currentIndex + 1];
                next_tab.click();
            }

        }, 3000);
    });

});