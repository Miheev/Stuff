<?php
/**
 * Order Item Meta
 *
 * A Simple class for managing order item meta so plugins add it in the correct format
 *
 * @class 		order_item_meta
 * @version		2.0.4
 * @package		WooCommerce/Classes
 * @author 		WooThemes
 */
class WC_Order_Item_Meta {

	public $meta;
	public $product;

	/**
	 * Constructor
	 *
	 * @access public
	 * @param string $item_meta (default: '')
	 * @return void
	 */
	public function __construct( $item_meta = array(), $product = null ) {
		$this->meta    = $item_meta;
		$this->product = $product;
	}

	/**
	 * Display meta in a formatted list
	 *
	 * @access public
	 * @param bool $flat (default: false)
	 * @param bool $return (default: false)
	 * @param string $hideprefix (default: _)
	 * @return string
	 */
	public function display( $flat = false, $return = false, $hideprefix = '_' ) {

		if ( ! empty( $this->meta ) ) {

			$meta_list = array();

			foreach ( $this->meta as $meta_key => $meta_values ) {

				if ( empty( $meta_values ) || ( ! empty( $hideprefix ) && substr( $meta_key, 0, 1 ) == $hideprefix ) )
					continue;

				foreach( $meta_values as $meta_value ) {

					// Skip serialised meta
					if ( is_serialized( $meta_value ) )
						continue;

					// If this is a term slug, get the term's nice name
		            if ( taxonomy_exists( esc_attr( str_replace( 'attribute_', '', $meta_key ) ) ) ) {
		            	$term = get_term_by('slug', $meta_value, esc_attr( str_replace( 'attribute_', '', $meta_key ) ) );
		            	if ( ! is_wp_error( $term ) && $term->name )
		            		$meta_value = $term->name;
		          	
		          	// If we have a product, and its not a term, try to find its non-sanitized name
		            } elseif ( $this->product ) {
						$product_attributes = $this->product->get_attributes();

						if ( isset( $product_attributes[ str_replace( 'attribute_', '', $meta_key ) ] ) ) {
							$meta_key = wc_attribute_label( $product_attributes[ str_replace( 'attribute_', '', $meta_key ) ]['name'] );
						}
		            }

					if ( $flat )
						$meta_list[] = wp_kses_post( wc_attribute_label( str_replace( 'attribute_', '', $meta_key ) ) . ': ' . apply_filters( 'woocommerce_order_item_display_meta_value', $meta_value ) );
					else
						$meta_list[] = '
							<dt class="variation-' . sanitize_html_class( sanitize_text_field( $meta_key ) ) . '">' . wp_kses_post( wc_attribute_label( str_replace( 'attribute_', '', $meta_key ) ) ) . ':</dt>
							<dd class="variation-' . sanitize_html_class( sanitize_text_field( $meta_key ) ) . '">' . wp_kses_post( wpautop( apply_filters( 'woocommerce_order_item_display_meta_value', $meta_value ) ) ) . '</dd>
						';

				}
			}

			if ( ! sizeof( $meta_list ) )
				return '';

			$output = $flat ? '' : '<dl class="variation">';

			if ( $flat )
				$output .= implode( ", \n", $meta_list );
			else
				$output .= implode( '', $meta_list );

			if ( ! $flat )
				$output .= '</dl>';

			if ( $return )
				return $output;
			else
				echo $output;
		}
	
		return '';
	}
}