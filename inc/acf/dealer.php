<div class="tailor-grid__item tailor-5a00cc52c5ecb">
<div class="tailor-element tailor-box tailor-box--image tailor-5a00cc52c5eca">
<div class="tailor-box__graphic"><img src="<?php the_field('logo'); ?>" alt=""></div>
<h3 class="tailor-box__title"><?php the_title(); ?></h3>
<div class="tailor-box__content">
<div class="tailor-element tailor-content tailor-5a00cc52c5eci">
<small style="display:block;margin-bottom:10px">
<?php
$mark = get_field('markets');
if($mark) :
foreach ($mark as $m) {
  $array[] = $m['label'];
}
echo 'Markets: '.implode(', ', $array);
endif;
?></small>
<?php the_field('more_info'); ?>
<?php echo '<span style="float:left">PH:</span>&nbsp; '. the_field('address'); ?>
<span class="phone"><?php the_field('phone'); ?></span><br>
<a href="<?php the_field('website'); ?>" target="_blank"><?php the_field('website'); ?></a>
<input type="hidden" value="<?php the_field('category'); ?>"/>
<span class="lat-long" style="display:none"><?php the_field('lat_long'); ?></span>
</div>
</div>
</div>
</div>
