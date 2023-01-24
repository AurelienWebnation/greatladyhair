<?php 
/*
Template Name: WooCommerce
*/ 
 
$kendall_elated_id = get_option('woocommerce_shop_page_id');
$kendall_elated_shop = get_post($kendall_elated_id);
$kendall_elated_sidebar = kendall_elated_sidebar_layout();

if(get_post_meta($kendall_elated_id, 'eltd_page_background_color', true) != ''){
	$kendall_elated_background_color = 'background-color: '.esc_attr(get_post_meta($kendall_elated_id, 'eltd_page_background_color', true));
}else{
	$kendall_elated_background_color = '';
}

$kendall_elated_content_style = '';
if(get_post_meta($kendall_elated_id, 'eltd_content-top-padding', true) != '') {
	if(get_post_meta($kendall_elated_id, 'eltd_content-top-padding-mobile', true) == 'yes') {
		$kendall_elated_content_style = 'padding-top:'.esc_attr(get_post_meta($kendall_elated_id, 'eltd_content-top-padding', true)).'px !important';
	} else {
		$kendall_elated_content_style = 'padding-top:'.esc_attr(get_post_meta($kendall_elated_id, 'eltd_content-top-padding', true)).'px';
	}
}

if ( get_query_var('paged') ) {
	$kendall_elated_paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$kendall_elated_paged = get_query_var('page');
} else {
	$kendall_elated_paged = 1;
}

get_header();

kendall_elated_get_title();
get_template_part('slider');

$kendall_elated_full_width = false;

if ( kendall_elated_options()->getOptionValue('eltd_woo_products_list_full_width') == 'yes' && !is_singular('product') ) {
	$kendall_elated_full_width = true;
}

if ( $kendall_elated_full_width ) { ?>
	<div class="eltd-full-width" <?php kendall_elated_inline_style($kendall_elated_background_color); ?>>
<?php } else { ?>
	<div class="eltd-container" <?php kendall_elated_inline_style($kendall_elated_background_color); ?>>
<?php }
/* if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
} */
woocommerce_breadcrumb();
?>
<?php
		if ( $kendall_elated_full_width ) { ?>
			<div class="eltd-full-width-inner" <?php kendall_elated_inline_style($kendall_elated_content_style); ?>>
		<?php } else { ?>
			<div class="eltd-container-inner clearfix" <?php kendall_elated_inline_style($kendall_elated_content_style); ?>>
		<?php }

			//Woocommerce content
			if ( ! is_singular('product') ) {
                $custom_woocommerce_sidebar=kendall_elated_get_woocommerce_sidebar();
				switch( $kendall_elated_sidebar ) {
					case 'sidebar-33-right': ?>
						<div class="eltd-two-columns-66-33 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1">
								<div class="eltd-column-inner">
									<?php kendall_elated_woocommerce_content(); ?>
								</div>
							</div>
							<div class="eltd-column2">
                                <?php
                                if (is_active_sidebar($custom_woocommerce_sidebar)) {
                                    dynamic_sidebar($custom_woocommerce_sidebar);
                                }
                                else {
                                    get_sidebar();
                                }
                                ?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-right': ?>
						<div class="eltd-two-columns-75-25 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1 eltd-content-left-from-sidebar">
								<div class="eltd-column-inner">
									<?php kendall_elated_woocommerce_content(); ?>
								</div>
							</div>
							<div class="eltd-column2">
                                <?php
                                if (is_active_sidebar($custom_woocommerce_sidebar)) {
                                    dynamic_sidebar($custom_woocommerce_sidebar);
                                }
                                else {
                                    get_sidebar();
                                }
                                ?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-33-left': ?>
						<div class="eltd-two-columns-33-66 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1">
                                <?php
                                if (is_active_sidebar($custom_woocommerce_sidebar)) {
                                    dynamic_sidebar($custom_woocommerce_sidebar);
                                }
                                else {
                                    get_sidebar();
                                }
                                ?>
							</div>
							<div class="eltd-column2">
								<div class="eltd-column-inner">
									<?php kendall_elated_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-left': ?>
						<div class="eltd-two-columns-25-75 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1">
                                <?php
                                if (is_active_sidebar($custom_woocommerce_sidebar)) {
                                    dynamic_sidebar($custom_woocommerce_sidebar);
                                }
                                else {
                                    get_sidebar();
                                }
                                ?>
							</div>
							<div class="eltd-column2 eltd-content-right-from-sidebar">
								<div class="eltd-column-inner">
									<?php kendall_elated_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					default:
						kendall_elated_woocommerce_content();
				}

			} else {
				kendall_elated_woocommerce_content();
			} ?>

			</div>
	</div>
<?php get_footer(); ?>
