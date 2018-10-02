(function ($) {
    "use strict";
	$(document).ready(function(){
			$('.book_launch_cabin .launch_cabin').click(function (e) {
				e.preventDefault();
				var totalSelected = get_total_selected_items();


				var itemAlreadySelected = false;
				if($(this).hasClass( "selected" )){
					 itemAlreadySelected = true;
				}
				if((totalSelected == seat_options.allow_seat_select_per_cart) && (!itemAlreadySelected)){
					alert('We do not allow '+seat_options.allow_seat_select_per_cart+' more at a time.');
					return;
				}

				$(this).toggleClass('selected');
				var cabinID = $(this).data('cabin_id');
				var cabinNumber = $(this).data('cabin_number');
				var cabinPrice = $(this).data('cabin_fare');
				cabinPrice = $.number(cabinPrice, 2);

				var cabinType = $(this).data('cabin_type');
				if(cabinType == 'double'){
					var cabinIDA = $(this).data('cabin_id_a');
					var cabinIDB = $(this).data('cabin_id_b');
					var cabinNumberA = $(this).data('cabin_number_a');
					var cabinNumberB = $(this).data('cabin_number_b');
					var cabinPriceA = $(this).data('cabin_fare_a');
					cabinPriceA = $.number(cabinPriceA, 2);
					var cabinPriceB = $(this).data('cabin_fare_b');
					cabinPriceB = $.number(cabinPriceB, 2);
				}

				if($(this).hasClass( "selected" )){
					if(cabinType == 'double'){
						var newCabin = $('<tr id="'+ cabinNumberA +'"><td>'+ cabinNumberA +'</td><td>&#x9f3;'+ cabinPriceA +'</td></tr><tr id="'+ cabinNumberB +'"><td>'+ cabinNumberB +'</td><td>&#x9f3;'+ cabinPriceB +'</td></tr>');
						var newCabinID = $('<input id="submit_cabin_'+ cabinIDA +'" type="hidden" name="cabin_ids[]" value="'+ cabinIDA +'"><input id="submit_cabin_'+ cabinIDB +'" type="hidden" name="cabin_ids[]" value="'+ cabinIDB +'">');
					}else{
						var newCabin = $('<tr id="'+ cabinNumber +'"><td>'+ cabinNumber +'</td><td>&#x9f3;'+ cabinPrice +'</td></tr>');
						var newCabinID = $('<input id="submit_cabin_'+ cabinID +'" type="hidden" name="cabin_ids[]" value="'+ cabinID +'">');
					}
					jQuery('.total_cabin_items').append(newCabin);
					jQuery('#form_process_request_cabins').append(newCabinID);
					$('#submit_cabins_request').removeAttr("disabled");
				}else{
					if(cabinType == 'double'){
						jQuery('.total_cabin_items tr#'+cabinNumberA).remove();
						jQuery('#form_process_request_cabins input#submit_cabin_'+cabinIDA).remove();
						jQuery('.total_cabin_items tr#'+cabinNumberB).remove();
						jQuery('#form_process_request_cabins input#submit_cabin_'+cabinIDB).remove();
					}else {
						jQuery('.total_cabin_items tr#'+cabinNumber).remove();
						jQuery('#form_process_request_cabins input#submit_cabin_'+cabinID).remove();
					}
				}
				//alert(totalPrice);
				var totalPrice = get_total_booking_price();
				totalPrice = $.number(totalPrice, 2);
				jQuery('#total_price').text(totalPrice);

				totalSelected = get_total_selected_items();
				if((totalSelected == 0)){
					$("#submit_cabins_request").prop("disabled", true);
				}


				//alert('Hello');
			});

			function get_total_selected_items(){
				var totalSelected = 0;
				$(".book_launch_cabin .launch_cabin.selected").each(function() {
						totalSelected++;
				});
				return totalSelected;
			}

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

})( jQuery );
