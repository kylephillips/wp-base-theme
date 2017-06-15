<?php get_header(); ?>
<div class="container">
<?php if (have_posts()) : ?>

	<h2><?php _e('Archives', 'textdomain'); ?></h2>
	
	<div class="post-archive-list">
	<?php 
		while ( have_posts() ) : the_post(); 
			get_template_part('partials/post', 'archive-listing');
		endwhile;
	?>
	</div>

	<?php get_template_part('partials/nav', 'basic'); ?>
			
	<?php else : ?>

		<h2><?php _e('No Posts found', 'textdomain'); ?></h2>

	<?php endif; ?>

</div><!-- .container -->

<?php 
get_footer();