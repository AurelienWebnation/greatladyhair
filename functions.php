<?php

/* Chargement de la feuille du style du theme parent */
add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles' );
function wpchild_enqueue_styles(){
  wp_enqueue_style( 'wpm-kendall-style', get_template_directory_uri() . '/style.css' );
}
// Change button text on WooCommerce Shop pages
add_filter( 'woocommerce_product_add_to_cart_text', 'woocustomizer_edit_shop_button_text' );

function woocustomizer_edit_shop_button_text() {
    global $product;
    $product_type = $product->get_type(); // Get the Product Type
	
    // Change text depending on Product type
    switch ( $product_type ) {
        case "variable":
            return __( 'Commander', 'woocommerce' );
            break;
        case "grouped":
            return __( 'Commander', 'woocommerce' );
            break;
        case "external":
            // Button label is added when editing the product
            //return esc_html( $product->get_button_text() );
            return __( 'Commander', 'woocommerce' );
            break;
		case 'simple':
			return __( 'Commander', 'woocommerce' );

		break;
        default:
            return __( 'Commander', 'woocommerce' );
    }
}

/* function breadcrumbs() {
    global $post;
    echo "<p id='breadcrumbs'>";
    if (!is_home()) {
        echo '<span><a href="' . get_option('home') . '">Accueil</a></span>';
        if (is_category() || is_single()) {
            echo " » <span>" . the_category(' </span><span> ');
            if (is_single()) {
                echo "</span> » <span>" . the_title() . "</span>";
            }
        } elseif (is_page()) {
            if($post->post_parent){
                foreach ( get_post_ancestors( $post->ID ) as $ancestor ) {
                    echo ' » <span><a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></span> » ' .  get_the_title();
                }
            } else {
                echo " » <span>" . get_the_title() . "</span>";
            }
        }
    } elseif (is_tag()) {
        single_tag_title();
    } elseif (is_day()) {
        echo " » <span>Archive du jour " . the_time('F jS, Y') . "</span>";
    } elseif (is_month()) {
        echo " » <span>Archive du mois " . the_time('F, Y') . "</span>";
    } elseif (is_year()) {
        echo " » <span>Archive de l'année " . the_time('Y') . "</span>";
    } elseif (is_author()) {
        echo " » <span>Auteur de l'archive</span>";
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
        echo " » <span>Archive du blog</span>";
    } elseif (is_search()) {
        echo " » <span>Résultats de recherche pour " . the_search_query() . "</span>";
    }
    echo "</p>";
} */

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}


/*
	Remove woocommerce product-category slug
*/
/* add_filter('request', function( $vars ) {
	global $wpdb;
	if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
		$slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
		$exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
		if( $exists ){
			$old_vars = $vars;
			$vars = array('product_cat' => $slug );
			if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
				$vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
			if ( !empty( $old_vars['orderby'] ) )
	 	        	$vars['orderby'] = $old_vars['orderby'];
      			if ( !empty( $old_vars['order'] ) )
 			        $vars['order'] = $old_vars['order'];	
		}
	}
	return $vars;
});

add_filter('term_link', 'term_link_filter', 10, 3);
function term_link_filter( $url, $term, $taxonomy ) {
    $url=str_replace("/./","/",$url);
     return $url;
} */
