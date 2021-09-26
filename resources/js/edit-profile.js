$(function(){
    $('.always-open').on('click', function(e){
     
      
        if ($('#always-open-checkbox').prop(
            "checked")) {
              
              $('.opening-hours').find('select').prop('disabled', true);
          } else {
            
              $('.opening-hours').find('select').prop('disabled', false);
          }
    });
})