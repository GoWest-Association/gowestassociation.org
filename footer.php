<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$admin_email = get_option( 'admin_email' );
?>
	
	</section>
	
	<?php if ( !isset( $_REQUEST['notemplate'] ) ) { ?>
	<footer class="footer">
		<a href="/"><img src="<?php bloginfo( "template_url" ); ?>/img/logo-white.png" alt="GoWest Association" /></a>
		<div class="address"><?php print apply_filters( 'the_content', get_option( 'pure_address' ) ); ?></div>
		<p class="copyright">Copyright &copy; <?php print date( 'Y' ) ?> GoWest Credit Union Association. All Rights Reserved.</p>
	</footer>
	<?php } ?>

</div><!-- #container -->

<?php wp_footer(); ?>
</body>
</html>