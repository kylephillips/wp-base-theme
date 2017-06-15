<?php get_header(); ?>

<div class="container">
<?php if ( have_posts()  ) : ?>

	<h2><?php _e('Search Results for', 'textdomain'); ?> &ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>
	
	<div class="post-archive-list">
	<?php while (have_posts() ) : the_post(); ?>
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
	<?php endwhile; ?>
	</div>

	<?php get_template_part('partials/nav', 'basic'); ?>

<?php else : ?>

<h2><?php _e('No Posts Found', 'textdomain'); ?></h2>

<?php endif; ?>
</div><!-- .container -->

<?php 
get_footer();