<?php
$link_before    = $after_link = $image = $thim_animation = $images_size = '';
$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );
$list_size = array("full", "thumbnail", "medium", "large");

if(!empty($instance['image_size']) ){
	if(!in_array($instance['image_size'], $list_size)){
		$images_size = explode("x", $instance['image_size']);
	}else{
		$image_size = $instance['image_size'];
	}
}else{
	$image_size = 'full';
}
$image   =   wp_get_attachment_image($instance['image'], $images_size, array('alt' => get_the_title()));
if ( $instance['image_link'] ) {
	$link_before = '<a href="' . $instance['image_link'] . '" target="' . $instance['link_target'] . '">';
	$after_link  = "</a>";
}

echo '<div class="single-image ' . $instance['image_alignment'] . $thim_animation . '">' . $link_before . $image . $after_link . '</div>';