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
/* woocommerce_breadcrumb(); */
?>
<?php
		if ( $kendall_elated_full_width ) { ?>
			<div class="eltd-full-width-inner" <?php kendall_elated_inline_style($kendall_elated_content_style); ?>>
		<?php } else { ?>
			<div class="eltd-container-inner clearfix" <?php kendall_elated_inline_style($kendall_elated_content_style); ?>>
		<?php }

			//Woocommerce content
			if ( ! is_singular('product') ) {
				if ( is_product_category() ) {
					$term_id  = get_queried_object_id();
					$taxonomy = 'product_cat';

					// Get subcategories of the current category
					$terms    = get_terms([
						'taxonomy'    => $taxonomy,
						'hide_empty'  => true,
						'parent'      => get_queried_object_id()
					]);
					
// 					$output = '';
					// Loop through product subcategories WP_Term Objects
					foreach ($terms as $category) {
						$products = new WP_Query([
							'post_type' => 'product',
							'post_per_page' => 10,
							'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									// 'terms' => 'white-wines'
									'terms' => $category->slug
								)
							),
						]);
						
						while ( $products->have_posts() ) {
							$products->the_post();
						}
						
						$term_link = get_term_link($category, $taxonomy);
						
						echo "<h3 style=\"text-align: center; background: -webkit-linear-gradient(top,#e163a1 0,#342d30 100%,#000 100%); color: white;\">{$category->name}</h3>" . "<div>" . the_title() . "</div>";
					}
				}
				switch( $kendall_elated_sidebar ) {
					case 'sidebar-33-right': ?>
						<div class="eltd-two-columns-66-33 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1">
								<div class="eltd-column-inner">
									<?php kendall_elated_woocommerce_content(); ?>
								</div>
							</div>
						</div>
				
                          
					</div>
				</div>	
			</div>
	</div>
<?php
	if (is_product_category()) {
		$current_term = get_queried_object();
	?>
		<div class="eltd-accordion-holder clearfix eltd-toggle eltd-boxed accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset">
			<h5 class="clearfix eltd-title-holder ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom">
			<span class="eltd-accordion-mark eltd-left-mark">
				<span class="eltd-accordion-mark-icon">
					<span class="icon_plus"></span>
					<span class="icon_minus-06"></span>
				</span>
			</span>
			<span class="eltd-tab-title">
				<span class="eltd-tab-title-inner">
					EN SAVOIR PLUS		</span>
			</span>
		</h5>
		<div class="eltd-accordion-content ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: none;">
			<div class="eltd-accordion-content-inner">

			<div class="wpb_text_column wpb_content_element ">
				<div class="wpb_wrapper">
				<?php echo term_description($current_term->term_id, $current_term->taxonomy); ?>
				</div>
			</div>
			</div>
		</div></div>
	<?php 
			}
		}
	} else {
		kendall_elated_woocommerce_content();
	}
		?>
<?php get_footer(); ?>

