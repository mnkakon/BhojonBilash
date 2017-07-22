/*=============================  Login & Register Modal ===============================*/

$(document).ready(function(){
	$('.modal').on('shown.bs.modal', function () {
        var curModal = this;
        $('.modal').each(function(){
            if(this != curModal){
                $(this).modal('hide');
            }
        });
    });
});



/*===============================================================
		Food Slider (Owl Carousel) 
=================================================================*/

$("#foodSlide").owlCarousel({              
    navigation : true, // Show next and prev buttons
    slideSpeed : 100,
    paginationSpeed : 400,
    navigationText : false,
    singleItem: true,
    autoPlay: true,
    pagination: false
});

/*----------------  testimonial   -----------------------------*/

$(document).ready(function() {
 
    $("#client-speech").owlCarousel({
     
        autoPlay: 5000, //Set AutoPlay to 3 seconds
        stopOnHover: true,
        singleItem:true
    });

});


/*====================================================
                Make Section Heights Equal
=====================================================*/
$(document).ready(function(){

    function resetSectionHeight() {
         $('.section_1').css('height', '');
         $('.section_2').css('height', '');
    }

    function fixSectionHeight() {
      
        var equalSections = $('.equal_height');

        for (index = 0; index < equalSections.length; ++index) {
            var sh1 = $(equalSections[index]).find('.section_1').height(),
                sh2 = $(equalSections[index]).find('.section_2').height(),
                newMaxHeight = Math.max(sh1,sh2);
            $(equalSections[index]).find('.section_1').height(newMaxHeight);
            $(equalSections[index]).find('.section_2').height(newMaxHeight);
        }
    }

    if( $(window).width() > 767 ) {
        fixSectionHeight();
    }
    else {
        resetSectionHeight();
    }

    $(window).resize(function() {
        resetSectionHeight();
        if( $(window).width() > 767 ) {
            fixSectionHeight();
        }
    });
    

});


/*=================================  bar chart  =============================*/

