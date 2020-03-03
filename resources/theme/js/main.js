

$(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});
});

$('#clickme').click(function() {
    var $slider = $('.mydiv');
    $slider.animate({
      left: parseInt($slider.css('left'),10) == -400 ?
       0 : -400
    });
  });
  $('#clickloc').click(function() {
    var $slider = $('.locdiv');
    $slider.animate({
      right: parseInt($slider.css('right'),10) == -380 ?
       0 : -380
    });
  });

	  $(".black ").hide().click(function(){
		return false;
	});
	// $(".white").show().click(function(){
	// 	$(".black ").slideToggle(150);
	// 	return false;
	// });
	$(document).click(function(){
		$(".black ").slideUp(150);
	});

$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){

       var canIncrement=true
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
       var id=$(this).attr('packageid')
       var type=$(this).attr('type1')
       if(type=='package'){
           $('.covers').each(function(){

               if($(this).val()>0){
                   canIncrement=false
                   return false
               }

           })
       }else{
           $('.packages').each(function(){

               if($(this).val()>0)
               {
                   canIncrement=false
                   return false
               }
           })
       }
       if(canIncrement==true){
           var quantity = parseInt($('#packpass-'+id).val());

           // If is not undefined

           // Increment
           if(quantity<10){
               $('#packpass-'+id).val(quantity + 1);
           }
       }else{
           alert("You can select either cover charges or packages")
       }



            // Increment

    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name

        var id=$(this).attr('packageid')

        var quantity = parseInt($('#packpass-'+id).val());

        // If is not undefined

            // Increment
            if(quantity>0){
                $('#packpass-'+id).val(quantity - 1);
            }
    });

});

$(document).ready(function(){

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current){
        $('#show-previous-image, #show-next-image').show();
        if(counter_max == counter_current){
            $('#show-next-image').hide();
        } else if (counter_current == 1){
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr){
        var current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image').click(function(){
            if($(this).attr('id') == 'show-previous-image'){
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-caption').text($sel.data('caption'));
            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if(setIDs == true){
            $('[data-image-id]').each(function(){
                counter++;
                $(this).attr('data-image-id',counter);
            });
        }
        $(setClickAttr).on('click',function(){
            updateGallery($(this));
        });
    }
});
