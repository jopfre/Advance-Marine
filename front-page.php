<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package advancemarine
 */

get_header(); ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">	
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'frontpage' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php /*get_sidebar();*/	 ?>
<?php get_footer(); ?>
<script type="text/javascript">
// (function($) {
// 		$('<img/>').attr('src', '<?php echo $thumb_url[0] ?>').load(function() {
// 	    $(this).remove(); // prevent memory leaks as @benweet suggested
// 	    $('body').hide();
// 	    $('body').css('background-image', 'url(<?php echo $thumb_url[0] ?>)');
// 	    $('body').fadeIn();
// 		});
// })(jQuery);

</script>
