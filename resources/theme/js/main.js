

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
        var id=$(this).attr('packageid')
        var quantity = parseInt($('#packpass-'+id).val());
        // Increment
        if(quantity>0){
            $('#packpass-'+id).val(quantity - 1);
        }
    });

     $('.quantity-ratio-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        var id=$(this).attr('ratioid')
        var quantity = parseInt($('#quantity-'+id).val());
        // Increment
        if(quantity>0){
            $('#quantity-'+id).val(quantity - 1);
        }
    });


    $('.quantity-ratio-plus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        var id=$(this).attr('ratioid')
        var quantity = parseInt($('#quantity-'+id).val());
        // Increment
        //if(quantity>0){
            $('#quantity-'+id).val(quantity + 1);
        //}
    });


    $('.quantity-minus-item').click(function(e){
        e.preventDefault();

        var id=$(this).attr('itemid')
        var type=$(this).attr('itemtype')
        var name=$(this).attr('itemname')
        var price=parseInt($(this).attr('itemprice'))

        if(type=='menu'){
            var quantity = parseInt($('#menu-'+id).val());

            // Increment
            if(quantity>0){
                quantity=quantity - 1
                $('#menu-'+id).val(quantity);
                $('.selected-items').each(function(){
                    if($(this).attr('itemid')==id && $(this).attr('itemtype')=='menu'){
                        $(this).remove()
                    }

                })

                var newitem='<tr itemid="'+id+'" itemtype="menu" class="selected-items">' +
                    '                                    <td scope="col" class="py-4"><strong>'+name+'</strong><br>' +
                    '                                        <small>Rs.'+price+'</small>' +
                    '                                    </td>' +
                    '                                    <td scope="col" class="py-4">' +
                    '                                        '+quantity+'' +
                    '                                    </td>' +
                    '                                    <td scope="col"class="py-4">' +
                    '                                        Rs.'+price*quantity+'' +
                    '                                        <span class="pull-right ml-3"><i class="fa fa-times" aria-hidden="true"></i></span>' +
                    '                                    </td>' +
                    '                                    <input type="hidden" name="menuid[]" value="'+id+'">' +
                    '                                    <input type="hidden" name="quantity[]" value="'+quantity+'">' +
                    '                                </tr>';
                //alert(newitem)
                if(quantity>0)
                    $('#selected_elements').append(newitem)
            }
        }else {

            var quantity = parseInt($('#package-' + id).val());

            // Increment
            if (quantity > 0) {
                quantity=quantity-1
                $('#package-' + id).val(quantity);
                $('.selected-items').each(function () {
                    if ($(this).attr('itemid') == id && $(this).attr('itemtype') == 'package') {
                        $(this).remove()
                    }

                })

                var newitem = '<tr itemid="' + id + '" itemtype="package" class="selected-items">' +
                    '                                    <td scope="col" class="py-4"><strong>' + name + '</strong><br>' +
                    '                                        <small>Rs.' + price + '</small>' +
                    '                                    </td>' +
                    '                                    <td scope="col" class="py-4">' +
                    '                                        ' + quantity + '' +
                    '                                    </td>' +
                    '                                    <td scope="col"class="py-4">' +
                    '                                        Rs.' + price * quantity + '' +
                    '                                        <span class="pull-right ml-3"><i class="fa fa-times" aria-hidden="true"></i></span>' +
                    '                                    </td>' +
                    '                                    <input type="hidden" name="itemid[]" value="' + id + '">' +
                    '                                    <input type="hidden" name="pass[]" value="' + quantity + '">' +
                    '                                </tr>';
                //alert(newitem)
                if(quantity>0)
                    $('#selected_elements').append(newitem)
            }


        }
        // If is not undefined


    });

    $('.quantity-plus-item').click(function(e){
        e.preventDefault();

        var id=$(this).attr('itemid')
        var type=$(this).attr('itemtype')
        var name=$(this).attr('itemname')
        var price=parseInt($(this).attr('itemprice'))

        if(type=='menu'){
            var quantity = parseInt($('#menu-'+id).val());

            // Increment
            if(quantity<10){
                quantity=quantity + 1
                $('#menu-'+id).val(quantity);
                $('.selected-items').each(function(){
                    if($(this).attr('itemid')==id && $(this).attr('itemtype')=='menu'){
                        $(this).remove()
                    }

                })

                var newitem='<tr itemid="'+id+'" itemtype="menu" class="selected-items">' +
                    '                                    <td scope="col" class="py-4"><strong>'+name+'</strong><br>' +
                    '                                        <small>Rs.'+price+'</small>' +
                    '                                    </td>' +
                    '                                    <td scope="col" class="py-4">' +
                    '                                        '+quantity+'' +
                    '                                    </td>' +
                    '                                    <td scope="col"class="py-4">' +
                    '                                        Rs.'+price*quantity+'' +
                    '                                        <span class="pull-right ml-3"><i class="fa fa-times" aria-hidden="true"></i></span>' +
                    '                                    </td>' +
                    '                                    <input type="hidden" name="menuid[]" value="'+id+'">' +
                    '                                    <input type="hidden" name="quantity[]" value="'+quantity+'">' +
                    '                                </tr>';
                //alert(newitem)
                if(quantity>0)
                    $('#selected_elements').append(newitem)
            }
        }else{
            var quantity = parseInt($('#package-'+id).val());

            // Increment
            if(quantity<10){
                quantity=quantity + 1
                $('#package-'+id).val(quantity);
                $('.selected-items').each(function(){
                    if($(this).attr('itemid')==id && $(this).attr('itemtype')=='package'){
                        $(this).remove()
                    }

                })

                var newitem='<tr itemid="'+id+'" itemtype="package" class="selected-items">' +
                    '                                    <td scope="col" class="py-4"><strong>'+name+'</strong><br>' +
                    '                                        <small>Rs.'+price+'</small>' +
                    '                                    </td>' +
                    '                                    <td scope="col" class="py-4">' +
                    '                                        '+quantity+'' +
                    '                                    </td>' +
                    '                                    <td scope="col"class="py-4">' +
                    '                                        Rs.'+price*quantity+'' +
                    '                                        <span class="pull-right ml-3"><i class="fa fa-times" aria-hidden="true"></i></span>' +
                    '                                    </td>' +
                    '                                    <input type="hidden" name="itemid[]" value="'+id+'">' +
                    '                                    <input type="hidden" name="pass[]" value="'+quantity+'">' +
                    '                                </tr>';
                //alert(newitem)
                if(quantity>0)
                    $('#selected_elements').append(newitem)
            }
        }



        // If is not undefined


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


let CURR_DATE = new Date();

const MONTHS = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
];

function getTotalDaysInMonth(year, month) {
 
  return 32 - new Date(year, month, 32)
    .getDate();
}

const grid = document.querySelectorAll('#calendar-table td');
const dateText = document.getElementById('date-text');

grid.forEach(cell => cell.onclick = function() {
  const selectedDate = cell.innerHTML;
  if (selectedDate === '')
    return;
  CURR_DATE.setDate(selectedDate);
  renderCalendar();
});

const calendarTitle = document.querySelectorAll('#calendar-title > span')[0];

// clears all cells
function clearGrid() {
  grid.forEach(cell => {
    cell.innerHTML = '';
    cell.classList.remove('today-cell');
  });
}

function renderCalendar(date = CURR_DATE) {
  clearGrid();
  
  // sets month and year
  calendarTitle.innerText = `${MONTHS[date.getMonth()]}, ${date.getFullYear()}`;
  
  const dayOfWeek  = date.getDay();
  const dateOfMnth = date.getDate();
  
  let totalMonthDays = getTotalDaysInMonth(
    date.getFullYear(),
    date.getMonth()
  );
  
  let startDay = dayOfWeek - dateOfMnth % 7 + 1;
  
  if (startDay < 0)
    startDay = (startDay + 35) % 7;
  
  for ( let i = startDay; i < totalMonthDays + startDay; i++ )
    grid[i % 35].innerHTML = (i - startDay + 1);
  
  grid[(startDay + dateOfMnth - 1) % 35].classList.add('today-cell');
  
  dateText.innerHTML = CURR_DATE.toLocaleDateString("en-US", { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
  
}

[...document.getElementsByClassName('btn')].forEach(btn => {
  
  let incr = 1;
  // left button decreases month
  if (btn.classList.contains('left'))
    incr = -1;
  
  btn.onclick = function() {
    CURR_DATE.setMonth(CURR_DATE.getMonth() + incr);
    renderCalendar(); 
  };
  
})
//clearGrid()
renderCalendar();

