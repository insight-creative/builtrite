<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BUILTRITE
 */

?>


	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_template_part( 'components/footer/site', 'contact' ); ?>
		<?php get_template_part( 'components/footer/site', 'info' ); ?>
		<?php get_template_part( 'components/footer/site', 'credits' ); ?>

	</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>
