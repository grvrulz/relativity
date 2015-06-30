<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Relativity
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'relativity' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'relativity' ), 'WordPress' ); ?></a>
			<br />
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'relativity' ), 'relativity', '<a href="http://magikpress.com/" rel="designer">MagikPress</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>