<?php

$terms = get_term_children(198, 'type');

foreach ($terms as $term) {
  $terms2[] = get_term($term);
}

foreach($terms2 as $k=>$v) {
    $sort[$k] = $v->slug;
}

array_keys($sort);
array_keys($terms);
sort($sort);

array_multisort($terms, SORT_ASC, $sort);

foreach ($terms as $term) :

$term = get_term($term);

$name = $term->name;
$slug = $term->slug;
//print_r($terms);
//echo $term->term_id;
$image = get_field('type_image', 'type_'.$term->term_id);
//echo $image;
?>

<div class="product-item">
<article id="post-<?php echo $term->term_id; ?>" class="<?php echo $term->slug; ?>">


 <div class="tailor-element tailor-box tailor-box--image" draggable="true" tailor-label="Box">
   <div class="tailor-box__graphic" style="margin-bottom:10px">
     <a href="<?php echo get_term_link($term); ?>">
       <?php
       if($image) : ?>
       <img src="<?php echo $image['sizes']['product-thumb']; ?>"/>
     <?php else : ?>
       <img src="<?php if(get_the_post_thumbnail()) : echo get_the_post_thumbnail_url(get_the_ID(),'product-thumb'); else : echo get_stylesheet_directory_uri().'/assets/img/placeholder.png'; endif; ?>"/>
     <?php endif; ?>
     </a>
   </div>
   <a href="<?php echo get_term_link($term); ?>"><h3 class="tailor-box__title"><?php echo $name; ?></h3></a>

       <br>
   <div class="tailor-element tailor-button tailor-button--primary tailor-button--medium tailor-button--medium-mobile tailor-button--medium-tablet" tailor-label="Button"><a style="text-align:center" class="tailor-button__inner" href="<?php echo get_term_link($term); ?>">View Products</a></div>

   </div>
</article>
</div>



<?php endforeach; ?>
