<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package advancemarine
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<!-- <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'advancemarine' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'advancemarine' ), 'WordPress' ); ?></a> -->
			<!-- <span class="sep"> | </span> -->
			<?php // printf( __( 'Theme: %1$s by %2$s.', 'advancemarine' ), 'advancemarine', '<a href="http://underscores.me/" rel="designer">jonathan freeland</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<style>
  body {
    background-image: url(<?php echo get_the_featured_image_url(); ?>);
  }
</style>
</body>
</html>
