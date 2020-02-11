<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BUILTRITE
 */

?>
<div class="product-item">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="tailor-element tailor-box--image tailor-5991c6a89dd94">
<div class="tailor-box__graphic"><img src="//localhost:3000/wp-content/uploads/2017/05/palceholder-dark.png" alt=""></div>
<h3 class="tailor-box__title"><?php echo $term->name; ?></h3>
<div class="tailor-box__content"><!-- tailor:content:5991c6a89dd93 -->
<div class="tailor-element tailor-content tailor-5991c6a89dd93">
<p><?php the_excerpt(); ?></p>
</div>

</div>
</article><!-- #post-## -->
