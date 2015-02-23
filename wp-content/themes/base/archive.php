<?php get_header(); ?>
<div class="container">
<?php if (have_posts()) : ?>

	<h2>Archives</h2>
	
	<ul class="post-archive-list">
	<?php 
		while ( have_posts() ) : the_post(); 
			include('inc/archive-post-list.php');
		endwhile;
	?>
	</ul>

	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			
	<?php else : ?>

		<h2>No Posts found</h2>

	<?php endif; ?>

</div><!-- .container -->

<?php get_footer(); ?>