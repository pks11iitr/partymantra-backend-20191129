

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
	$(".white").show().click(function(){
		$(".black ").slideToggle(150);
		return false;
	});
	$(document).click(function(){
		$(".black ").slideUp(150);
	});

$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});