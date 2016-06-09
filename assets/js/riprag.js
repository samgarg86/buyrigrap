jQuery(function(){
	// 0 means no buying limit
	var MAX_QUANTITIES = {
		valuepack: 1,
		freethreader: 1,
		halfpricevaluepacks: 3
	}

	var $addToCart = jQuery(".add_to_cart_inline a");

	var getCartQuantities = function(callback) {
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "cart_quantities"
			},
			success: callback
		});
	}

	var setAddToCartButtonQuantities = function($button, buying) {
		var sku = $button.data("product_sku");
		var product_id = $button.data("product_id");
		var $quantityInput = jQuery("." + sku + "-quantity");

		getCartQuantities(function(resp) {
			var bought = 0;
			var allowedToBuy = 20; //Unlimited

			if (resp[product_id]) {
				bought = resp[product_id];
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
		});
	}

	// On first load, disable buttons if max quantity already added to cart
	$addToCart.each(function(){
		setAddToCartButtonQuantities(jQuery(this));
	});

	$addToCart.click(function(){
		// Send quantity from quantity input box
		var $clicked = jQuery(this);
		var sku = $clicked.data("product_sku");
		var $quantity = jQuery("." + sku + "-quantity");
		$clicked.data("quantity", $quantity.val());
		///$quantity.val(1);

		// Disable button if max quantity added to cart
		setAddToCartButtonQuantities(jQuery(this), true);
	});

	jQuery('.cart-quantities').click(function(){
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: "/wp-admin/admin-ajax.php",
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
	if(jQuery(".cart-empty").length) {
		jQuery('.free-multi-tool').hide();
	}

	jQuery('#billing_country').change(function(){
		if(jQuery('#billing_country').val() === 'US'){
			jQuery('.woocommerce-checkout-review-order-table tr.shipping').hide();
		}
		else {
			jQuery('.woocommerce-checkout-review-order-table tr.shipping').show();
		}
	});

	// Menu bar cart plugin - cart icon point to checkout page instead of cart
	jQuery('.wpmenucart-contents').attr('href', '/checkout');

	//jQuery('.rigrap-cart .product-remove .remove1').click(function(){
	//
	//	$this = jQuery(this);
	//	var product_id = $this.attr("data-product_id");
	//	jQuery.ajax({
	//		type: 'POST',
	//		dataType: 'json',
	//		url: "/wp-admin/admin-ajax.php",
	//		data: { action: "product_remove",
	//			product_id: product_id
	//		},
	//		success: function(resp){
	//			console.log(product_id + "removed from the cart.");
	//			$this.closest(".row.cart_item").remove();
	//			$('.cart-collaterals').html(resp.html);
	//		}
	//	});
	//	return false;
	//});
});
