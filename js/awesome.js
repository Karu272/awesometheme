//javascript function

jQuery(document).ready(function($) {

    $(document).on('click','.open-search a', function(e){
       // prevent the jump effect
        e.preventDefault();

        $('.search-form-container').slideToggle(350);

    });

});