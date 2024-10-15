<?php
$image_icon       = $image_background = '';
$image_size = !empty($instance['image_size']) ? $instance['image_size'] : 'thumbnail'; 
if ( $instance['small_title'] ) {
	$small_title = '<div class="small-title">' . $instance['small_title'] . '</div>';
}

if ( $instance['title'] ) {
	$title = '<h3 class="title">' . $instance['title'] . '</h3>';
}
if ( $instance['image_link'] ) {
	$link_before = '<a target="' . $instance['link_target'] . '" href="' . $instance['image_link'] . '">';
	$after_link  = "</a>";
}else{
	$link_before = '';
	$after_link = '';
}

?>
<div class="box_image style_2">
	<?php echo ent2ncr($link_before); ?>
	<div class="image_background">
		<?php echo wp_get_attachment_image($instance['image_background'], $image_size, array('alt' => get_the_title())); ?>
	</div>
	<div class="content-box">
		<div class="icon-image">
			<?php echo wp_get_attachment_image($instance['image_icon'], $image_size, array('alt' => get_the_title())); ?>
		</div>
		<div class="content-text">
			<?php echo $small_title; ?>
			<?php echo $title; ?>
		</div>
	</div>
	<?php echo ent2ncr($after_link); ?>
</div>

