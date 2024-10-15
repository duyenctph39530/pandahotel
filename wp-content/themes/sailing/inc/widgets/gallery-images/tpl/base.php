<?php
wp_enqueue_script('owl-carousel');
$link_before = $after_link = $image = $style_width = '';
if ( $instance['image'] ) {
	if ( $instance['link_target'] ) {
		
		$t = 'target="' . $instance['link_target'] . '"';
	} else {
		$t = '';
	}

	if ( !is_array( $instance['image'] ) ) {
		$img_id = explode( ",", $instance['image'] );
	} else {
		$img_id = $instance['image'];
	}

	if ( $instance['image_link'] ) {
		$img_url = explode( ",", $instance['image_link'] );
	}

	
	echo '<div class="thim-gallery-images owl-carousel gallery-img">';
	$i = 0;
	foreach ( $img_id as $id ) {
		$image_size = !empty($instance['image_size']) ? $instance['image_size'] : 'full';
		$image  =  wp_get_attachment_image($id, $image_size, array('alt' => get_the_title()));
		if ( $instance['image_link'] ) {
			if( !empty($img_url[$i]) ){
				$link_before = '<a ' . $t . ' href="' . esc_url( $img_url[$i] ) . '">';
				$after_link  = "</a>";
			}else {
				$link_before = '<a ' . $t . ' href="' . esc_url( $img_url[0] ) . '">';
				$after_link  = "</a>";
			}
		}
		echo '<div class="item"' . $style_width . '>' . $link_before . $image . $after_link . "</div>";
		$i ++;
	}
	echo "</div>";
}