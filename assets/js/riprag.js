jQuery(function(){
	// 0 means no buying limit
	var MAX_QUANTITIES = {
		valuepack: 1,
		freethreader: 1,
		halfpricevaluepacks: 3
	}

	var AJAX_URL = "/wordpress/wp-admin/admin-ajax.php";

	// Menu bar cart plugin - cart icon point to checkout page instead of cart
	jQuery('.wpmenucart-contents').attr('href', '/checkout');

	var $addToCart = jQuery(".add_to_cart_inline a");
	var valuepackId = jQuery('.add_to_cart_inline a[data-product_sku="valuepack"]').data("product_id");
	var deluxepackId = jQuery('.add_to_cart_inline a[data-product_sku="deluxebundle"]').data("product_id");

	var getCartQuantities = function(callback) {
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: AJAX_URL,
			data: {
				action: "cart_quantities"
			},
			success: callback
		});
	}

	var refreshAddToCartButton = function($button, cart_quantities, buying) {
		var sku = $button.data("product_sku");
		var product_id = $button.data("product_id");
		var $quantityInput = jQuery("." + sku + "-quantity");
		var bought = 0;
		var allowedToBuy = 20; //Unlimited

		if (cart_quantities[product_id]) {
			bought = cart_quantities[product_id];
		}
		if (buying ) {
			bought += $quantityInput.val()? parseInt($quantityInput.val()) : 1;
			if($quantityInput.val()) {$quantityInput.val(1);}
		}

		if (MAX_QUANTITIES[sku]) {
			allowedToBuy = MAX_QUANTITIES[sku];
		}

		$quantityInput.attr('max', allowedToBuy - bought);

		if (bought >= allowedToBuy) {
			$button.addClass('disabled added');
		}
		console.log('allowedToBuy', allowedToBuy, 'bought', bought);
	}

	function checkForHalfPriceOffer (cart_quantities) {
		return !jQuery.isEmptyObject(cart_quantities) && valuepackId && deluxepackId
			&& (cart_quantities[valuepackId] || cart_quantities[deluxepackId]);
	}

	function checkForFreeMultiOffer (cart_quantities) {
		return !jQuery.isEmptyObject(cart_quantities);
	}

	// On first load, disable buttons if max quantity already added to cart
	getCartQuantities(function(resp) {
		$addToCart.each(function(){
			refreshAddToCartButton(jQuery(this), resp);
		});
	});

	$addToCart.click(function(e, options){
		options = options || {};

		// Send quantity from quantity input box
		var $clicked = jQuery(this);
		var sku = $clicked.data("product_sku");
		var $quantity = jQuery("." + sku + "-quantity");
		$clicked.data("quantity", $quantity.val());

		// Only allow buying half price value packs if
		// atleast one value pack or deluxe pack has been bought
		if(!options.checkedForOffers && (sku == "halfpricevaluepacks" || sku == "freethreader")) {
			e.preventDefault();
			e.stopPropagation();

			getCartQuantities(function(resp) {
				if (sku == "halfpricevaluepacks" && !checkForHalfPriceOffer(resp)) {
					alert("Half Price Value Packs are available ONLY if you purchase one Angler’s Choice Value Pack or a RIGRAP Deluxe Storage and Accessory Bundle. " +
					"You can buy up to 3 more Value Packs for only $9.99 + S&H");
				}
				else if (sku == "freethreader" && !checkForFreeMultiOffer(resp)) {
					alert("Free MultiThreader is only available if you add something else to the cart.");
				}
				else {
					// Disable button if max quantity added to cart
					$clicked.trigger('click', {checkedForOffers: true});
				}
			});
		}
		else {
			getCartQuantities(function(resp) {
				refreshAddToCartButton($clicked, resp, true);
			});
		}
	});

	// Just a test function
	jQuery('.cart-quantities').click(function(){
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: AJAX_URL,
			data: {
				action: "cart_quantities"
			},
			success: function(resp){
				console.log(resp);
			}
		});
	})

	jQuery('.add-to-cart-quantity .minus').click(function(e) {
		var $this = jQuery(this);
		var $quantity = $this.siblings('.quantity');
		var quantityVal = $quantity.val();
		var updatedQuantity = (quantityVal > 1)?(quantityVal-1) : 1;
		$quantity.val(updatedQuantity);
	});

	jQuery('.add-to-cart-quantity .plus').click(function(e) {
		var $this = jQuery(this);
		var $quantity = $this.siblings('.quantity');

		var quantityVal = parseInt($quantity.val());
		var max = parseInt ($quantity.attr('max'));

		if(quantityVal < max) {
			var updatedQuantity = parseInt(quantityVal) + 1;
			$quantity.val(updatedQuantity);
		}
	});

	// Hide free multi tool promo if cart is empty
	//if(jQuery(".cart-empty").length) {
	//	jQuery('.free-multi-tool').hide();
	//}

	//jQuery('#billing_country').change(function(){
	//	if(jQuery('#billing_country').val() === 'US'){
	//		jQuery('.woocommerce-checkout-review-order-table tr.shipping').hide();
	//	}
	//	else {
	//		jQuery('.woocommerce-checkout-review-order-table tr.shipping').show();
	//	}
	//});


	// Shopping Cart
	jQuery('.product-remove a.remove').click(function(){
		var $this = jQuery(this);
		var product_id = $this.data("product_id");
		var product_sku = $this.data("product_sku");
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: AJAX_URL,
			data: {
				action: "product_remove",
				product_id: product_id,
				product_sku: product_sku
			},
			success: function(resp){
				if(!resp.lineItemRemoved) {
					console.error("Can't remove line item, something went wrong..");
					return;
				}

				$('.row.cart_item[data-product_sku="' + product_sku + '"]').remove();
				$('.cart-collaterals').html(resp.html);

				if(resp.halfPriceDealRemoved) {
					$('.row.cart_item[data-product_sku="halfpricevaluepacks"]').remove();
					alert('Half Priced Value Packs are also removed. You need to add a Value Pack or Deluxe Pack to the cart to claim your Half Price Offer!');
				}

				if(resp.freeThreaderRemoved) {
					$('.row.cart_item[data-product_sku="freethreader"]').remove();
					alert('Free Threader Tool also removed. You need to add a Value Pack to claim your Free Threader Tool!');
				}
			}
		});
		return false;
	});

});
