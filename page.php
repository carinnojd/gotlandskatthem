<?php while (have_posts()) : the_post(); ?>

<?php 

$image = get_field('image');
var_dump($image);
if( !empty($image) ): 

	// vars
	$url = $image['url'];
	$title = $image['title'];
	$alt = $image['alt'];
	$caption = $image['caption'];

	// thumbnail
	$size = 'large';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];

	if( $caption ): ?>

		<div class="">

	<?php endif; ?>

	<a href="<?php echo $url; ?>" title="<?php echo $title; ?>">

		<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

	</a>

	<?php if( $caption ): ?>

			<p class="wp-caption-text"><?php echo $caption; ?></p>

		</div>

	<?php endif; ?>

<?php endif; ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
