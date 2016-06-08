jQuery(function(){
	var $addToCart = jQuery(".add_to_cart_inline a");
	var $addToCartFreeThreader = jQuery('.add_to_cart_inline a[data-product_sku="freethreader"]');

	$addToCart.click(function(){
		var $clicked = jQuery(this);
		var sku = $clicked.data("product_sku");
		if(sku === "freethreader") {
			$clicked.addClass('disabled');
		}

		var quantity = jQuery("." + sku + "-quantity").val();
		$clicked.data("quantity", quantity);
	});

	if(jQuery('.rigrap-cart .cart_item[data-product_sku="freethreader"]').length) {
		$addToCartFreeThreader.addClass('disabled added');
	}
	else {
		$addToCartFreeThreader.removeClass('disabled').removeClass('added');
	}

	jQuery('.add-to-cart-quantity .minus').click(function(e){
		var $this = jQuery(this);
		var $quantity = $this.siblings('.quantity');
		var quantityVal = $quantity.val();
		var updatedQuantity = (quantityVal > 1)?(quantityVal-1) : 1;
		$quantity.val(updatedQuantity);
	});

	jQuery('.add-to-cart-quantity .plus').click(function(e){
		var $this = jQuery(this);
		var $quantity = $this.siblings('.quantity');
		var quantityVal = $quantity.val();
		var updatedQuantity = parseInt(quantityVal) + 1;
		$quantity.val(updatedQuantity);
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
