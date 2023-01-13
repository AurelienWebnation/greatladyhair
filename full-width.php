<?php 
/*
Template Name: Full Width
*/
$kendall_elated_sidebar = kendall_elated_sidebar_layout();
//echo do_shortcode("[breadcrumb]"); 
get_header();
kendall_elated_get_title(); 
get_template_part('slider');
//echo do_shortcode("[breadcrumb]"); 
?>
<div class="eltd-section-inner">
<?php
woocommerce_breadcrumb();	
?>
</div>



<div class="eltd-full-width">
<div class="eltd-full-width-inner">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(($kendall_elated_sidebar == 'default')||($kendall_elated_sidebar == '')) : ?>
			<?php the_content(); ?>
			<?php do_action('kendall_elated_page_after_content'); ?>
		<?php elseif($kendall_elated_sidebar == 'sidebar-33-right' || $kendall_elated_sidebar == 'sidebar-25-right'): ?>
			<div <?php echo kendall_elated_sidebar_columns_class(); ?>>
				<div class="eltd-column1 eltd-content-left-from-sidebar">
					<div class="eltd-column-inner">
						<?php the_content(); ?>
						<?php do_action('kendall_elated_page_after_content'); ?>
					</div>
				</div>
				<div class="eltd-column2">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php elseif($kendall_elated_sidebar == 'sidebar-33-left' || $kendall_elated_sidebar == 'sidebar-25-left'): ?>
			<div <?php echo kendall_elated_sidebar_columns_class(); ?>>
				<div class="eltd-column1">
					<?php get_sidebar(); ?>
				</div>
				<div class="eltd-column2 eltd-content-right-from-sidebar">
					<div class="eltd-column-inner">
						<?php the_content(); ?>
						<?php do_action('kendall_elated_page_after_content'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
<?php get_footer(); ?>
