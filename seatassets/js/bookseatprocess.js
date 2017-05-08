$(document).ready(function(){
		$('.book_launch_cabin .launch_cabin').click(function (e) {
			e.preventDefault();
			$(this).toggleClass('selected');
			var cabinNumber = $(this).data('cabin_number');
			var cabinPrice = $(this).data('cabin_fare');
			cabinPrice = $.number(cabinPrice, 2);

			if($(this).hasClass( "selected" )){
				var newCabin = $('<tr id="'+ cabinNumber +'"><td>'+ cabinNumber +'</td><td>&#x9f3;'+ cabinPrice +'</td></tr>');
	      jQuery('.total_cabin_items').append(newCabin);
			}else{
					jQuery('.total_cabin_items tr#'+cabinNumber).remove();
			}
			//alert(totalPrice);
			var totalPrice = get_total_booking_price();
			totalPrice = $.number(totalPrice, 2);
			jQuery('#total_price').text(totalPrice);



			//alert('Hello');
		});

		function get_total_booking_price(){
			var totalPrice = 0;

			$(".book_launch_cabin .launch_cabin.selected").each(function() {
					var cabinPrice = $(this).data('cabin_fare');
					totalPrice += cabinPrice;

			});

			return totalPrice;
		}

});
