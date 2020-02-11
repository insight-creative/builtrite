<?php
if(is_tax('type'))  :
	$term = get_queried_object();
	$term = $term->term_taxonomy_id;
	$img = get_field('type_image', 'term_'.$term );
	$img = $img['sizes']['large'];
	if($img) :
	$conditional_image = 'style="background-image:url('.$img.')"';
	else :
	$conditional_image = '';
	endif;
endif;

if(is_tax('industry'))  :
	$term = get_queried_object();
	$term = $term->term_taxonomy_id;
	$img = get_field('type_image', 'term_'.$term );
	$img = $img['sizes']['large'];
	if($img) :
	$conditional_image = 'style="background-image:url('.$img.')"';
	else :
	$conditional_image = '';
	endif;
endif;

if(is_page_template('page-products.php'))  :
	$term = get_queried_object();
	$term = $term->term_taxonomy_id;
	$img = get_the_post_thumbnail_url();
	//$img = $img['sizes']['large'];
	if($img) :
	$conditional_image = 'style="background-image:url('.$img.')"';
	else :
	$conditional_image = '';
	endif;
endif;

if(is_home()) :
	$conditional_image = 'style="background-image:url('.get_the_post_thumbnail_url().')"';
endif;
 ?>

<header id="hero" <?php echo $conditional_image; ?> id="hero" class="tailor-element tailor-section page-header">
	<div class="tailor-section__content">
		<div class="tailor-element tailor-hero tailor-5980ecd12d5d7">
			<div class="tailor-hero__content"><!-- tailor:content:5980ecd12d5d8 -->
				<div class="tailor-element tailor-content tailor-5980ecd12d5d8">
					<?php
					if(is_page()) {
						the_title('<h1 class="page-title">', '</h1>');
					} elseif(is_home()) {
						echo '<h1>Company News</h1>';
					} else {
						the_archive_title('<h1 class="page-title">', '</h1>');
					}
					//	the_archive_description('<div class="taxonomy-description">', '</div>');
						?>
				</div>
			</div>
	</div>
</header>
