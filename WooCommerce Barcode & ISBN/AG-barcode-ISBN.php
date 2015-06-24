<?php
/*
Plugin Name: WooCommerce Barcode & ISBN
Plugin URI: https://www.weareag.co.uk/add-barcode-meta-box-woocommerce/
Description: A plugin to add a barcode & ISBN field to WooCommerce
Author: We are AG
Version: 1.0
Author URI: https://www.weareag.co.uk
*/

// Add barcode & ISBN to product edit screen

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_barcode' );


function woo_add_barcode() {

    global $woocommerce, $post;
    // Text Field
    woocommerce_wp_text_input(
        array(
            'id' => 'barcode',
            'label' => __( 'Barcode', 'woocommerce' ),
            'placeholder' => 'barcode here',
            'desc_tip' => 'true',
            'description' => __( 'Product barcode.', 'woocommerce' )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'ISBN',
            'label' => __( 'ISBN', 'woocommerce' ),
            'placeholder' => 'ISBN here',
            'desc_tip' => 'true',
            'description' => __( 'Product ISBN.', 'woocommerce' )
        )
    );
}
function woo_add_barcode_save( $post_id ){

    // Saving Barcode
    $barcode = $_POST['barcode'];
    if( !empty( $barcode ) ) {
        update_post_meta( $post_id, 'barcode', esc_attr( $barcode ) );
    } else {
        update_post_meta( $post_id, 'barcode', esc_attr( $barcode ) );
    }
    // Saving ISBN
    $ISBN = $_POST['ISBN'];
    if( !empty( $ISBN ) ) {
        update_post_meta( $post_id, 'ISBN', esc_attr( $ISBN ) );
    } else {
        update_post_meta( $post_id, 'ISBN', esc_attr( $ISBN ) );
    }
}

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_barcode_save' );
// End of adding barcode & ISBN to product edit screen


// Add to front end
function add_barcode_under_sku() {

    if (get_post_meta( get_the_ID(), 'barcode', true )) { ?>

<span class="barcode_wrapper"><?php _e( 'Barcode:', 'woocommerce' ); ?> <span class="barcode" itemprop="barcode"><?php echo get_post_meta( get_the_ID(), 'barcode', true ); ?></span>.</span>

<?php if (get_post_meta( get_the_ID(), 'barcode', true ) && get_post_meta( get_the_ID(), 'ISBN', true )) { ?>
    <br>
<?php } else { } ?>


<?php } else { }
    if (get_post_meta( get_the_ID(), 'ISBN', true )) { ?>
<span class="isbn_wrapper"><?php _e( 'ISBN:', 'woocommerce' ); ?> <span class="ISBN" itemprop="ISBN"><?php echo get_post_meta( get_the_ID(), 'ISBN', true ); ?></span>.</span>
   <?php } else { }
}
add_action( 'woocommerce_product_meta_end', 'add_barcode_under_sku', 21 );
// End
