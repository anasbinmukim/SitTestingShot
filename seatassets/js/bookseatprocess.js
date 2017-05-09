$(document).ready(function(){
		$('.book_launch_cabin .launch_cabin').click(function (e) {
			e.preventDefault();
			$(this).toggleClass('selected');
			var cabinID = $(this).data('cabin_id');
			var cabinNumber = $(this).data('cabin_number');
			var cabinPrice = $(this).data('cabin_fare');
			cabinPrice = $.number(cabinPrice, 2);

			if($(this).hasClass( "selected" )){
				var newCabin = $('<tr id="'+ cabinNumber +'"><td>'+ cabinNumber +'</td><td>&#x9f3;'+ cabinPrice +'</td></tr>');
				var newCabinID = $('<input id="submit_cabin_'+ cabinID +'" type="hidden" name="cabin_ids[]" value="'+ cabinID +'">');
	      jQuery('.total_cabin_items').append(newCabin);
				jQuery('#form_process_request_cabins').append(newCabinID);
			}else{
					jQuery('.total_cabin_items tr#'+cabinNumber).remove();
					jQuery('#form_process_request_cabins input#submit_cabin_'+cabinID).remove();
			}
			//alert(totalPrice);
			var totalPrice = get_total_booking_price();
			totalPrice = $.number(totalPrice, 2);
			jQuery('#total_price').text(totalPrice);



			//alert('Hello');
		});

		function get_total_booking_price(){
			var totalPrice = 0;
			var totalSelected = 0;
			$(".book_launch_cabin .launch_cabin.selected").each(function() {
					var cabinPrice = $(this).data('cabin_fare');
					totalPrice += cabinPrice;

					totalSelected++;
			});

			jQuery('#total_number_of_selected_cabin').text(totalSelected);

			return totalPrice;
		}

});
