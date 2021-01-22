require('./bootstrap');

(function($){

    $(document).ready(function(){
       
        let phone = $('.input-phone');

        if ( phone.length > 0 ) {
            phone.mask('+55 (00) 0 0000-0000');
        }   
    });
    
})(jQuery);