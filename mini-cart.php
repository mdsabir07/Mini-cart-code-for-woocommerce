<?php 

// Markup from woocommerc.php 
if ( ! function_exists( 'wnew_shop_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function wnew_shop_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		wnew_shop_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wnew_shop_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'wnew_shop_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function wnew_shop_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'wnew-shop' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'wnew-shop' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'wnew_shop_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function wnew_shop_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php wnew_shop_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

function wnew_shop_woocommerce_cart_link() {
	global $woocommerce;
	$total = $woocommerce->cart->total;

	$items = $woocommerce->cart->get_cart(); 
	
	$cartcount = WC()->cart->get_cart_contents_count();
	if ($cartcount > 0) { echo $cartcount; }
	?>
	
	<div class="wns-mini-cart">
		<div class="wns-mini-cart-icon">
			<a href="<?php echo esc_url(wc_get_cart_url()); ?>"><i class="fa fa-shopping-cart"></i></a>
			<span class="wns-mini-cart-count"><?php echo $cartcount; ?></span>
		</div>
		
		<?php if(!empty($items)) : ?>
		<div class="wns-mini-cart-items">
			<?php woocommerce_mini_cart(); ?>
		</div>
		<?php endif; ?>
	</div>

	<?php
}

function wnew_shop_woocommerce_cart_link_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	wnew_shop_woocommerce_cart_link();
	$fragments['.wns-mini-cart'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wnew_shop_woocommerce_cart_link_fragment' );

function wnew_shop_woocommerce_cart_link() {
	global $woocommerce;
	$total = $woocommerce->cart->total;

	$items = $woocommerce->cart->get_cart(); 
	
	$cartcount = WC()->cart->get_cart_contents_count();
	if ($cartcount > 0) { echo $cartcount; }
	?>
	
	<div class="wns-mini-cart">
		<div class="wns-mini-cart-icon">
			<a href="<?php echo esc_url(wc_get_cart_url()); ?>"><i class="fa fa-shopping-cart"></i></a>
			<span class="wns-mini-cart-count"><?php echo $cartcount; ?></span>
		</div>
		
		<?php if(!empty($items)) : ?>
		<div class="wns-mini-cart-items">
			<?php woocommerce_mini_cart(); ?>
		</div>
		<?php endif; ?>
	</div>

	<?php
}

function wnew_shop_woocommerce_cart_link_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	wnew_shop_woocommerce_cart_link();
	$fragments['.wns-mini-cart'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wnew_shop_woocommerce_cart_link_fragment' );
?>


<!-- Markup from header.php --> 
<?php if(class_exists( 'WooCommerce' )) : ?>
<div class="wns-header-shopping-cart">
	<?php wnew_shop_woocommerce_cart_link(); ?>
</div>
<?php endif; ?>

<!-- Markup from function.php -->
<!-- /**
 * Load WooCommerce compatibility file.
 */ -->
<?php
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
