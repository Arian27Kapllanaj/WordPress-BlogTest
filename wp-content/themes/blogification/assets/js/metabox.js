jQuery(document).ready(function(){jQuery("#blogification-ui-tabs").tabs()});

jQuery(function($){
    jQuery(document).on('change', 'input:radio[name="widget-widget_trending_posts[7][types]"]:checked', function( event ){
        let value = $('input:radio[name="widget-widget_trending_posts[7][types]"]:checked').val()
        if(value != 'category'){
          $("#select-category").hide();
        }else{
          $("#select-category").show();
        }
    })
});
