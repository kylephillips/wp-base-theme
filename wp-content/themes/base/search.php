<?php get_header(); ?>

<div class="container">
<?php if ( have_posts()  ) : ?>

	<h2>Search Results for &ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>
	<ul class="post-archive-list">
	<?php while (have_posts() ) : the_post(); ?>

		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>

	<?php endwhile; ?>
	</ul>
	<?php include ('inc/nav.php' ); ?>

<?php else : ?>

<h2>No Posts Found</h2>

<?php endif; ?>
</div><!-- .container -->

<?php get_footer(); ?>