jQuery(document).ready(function ($) {
    jQuery(function () {
        $("#seocheck_error-modal").dialog({
            modal: true,
            width: 450,
            buttons: {
                Ok: function () {
                    $(this).dialog("close");
                }
            }
        });
    });
    
    jQuery(function (){
        $('#eranker-plugin-widget-2 .factor-name').each(function(){
           $(this).removeClass('col-xs-12 col-sm-12 col-md-4 col-lg-3');
           $(this).addClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
        });

        $('#eranker-plugin-widget-2 .factor-data').each(function(){
           $(this).removeClass('col-xs-12 col-sm-12 col-md-8 col-lg-9');
           $(this).addClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
        });
        
        $('#eranker-plugin-widget-2 .responsivenesswrapper').each(function(){
           $(this).removeClass('col-xs-12 col-sm-12 col-md-6 col-lg-6');
           $(this).addClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
        });
        
        $('#eranker-plugin-widget-2 .factors-percent').each(function(){
           $(this).removeClass('col-sm-4 col-md-2 col-lg-3 col-lg-3');
           $(this).addClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
        });
        
        $('#eranker-plugin-widget-2 .factors-score').each(function(){
           $(this).removeClass('col-sm-8 col-md-5 col-lg-5');
           $(this).addClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
        });
        
        $('#eranker-plugin-widget-2 .factors-site').each(function(){
           $(this).removeClass('col-md-5 hidden-xs hidden-sm col-lg-4');
           $(this).addClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
        });
    });
    
});



