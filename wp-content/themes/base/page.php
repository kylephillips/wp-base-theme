<?php 
get_header(); 
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<div class="container">
	<h2><?php the_title(); ?></h2>
	<?php the_content(); ?>
</div><!-- .container -->

<?php 
endwhile; endif;
get_footer();