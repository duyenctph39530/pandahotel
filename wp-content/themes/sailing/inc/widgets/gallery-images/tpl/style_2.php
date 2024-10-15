<?php
wp_enqueue_script('owl-carousel');
$link_before = $after_link = $image  = $style_width = $extra_content = $class = '';
$columns = 4;
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

	if ( isset($instance['columns']) ) {
		$columns = $instance['columns'];
	}

	if ( isset($instance['popup_style']) && $instance['popup_style'] == 'yes' ) {
		$class = 'popup_style';
	}

	echo '<div class="thim-gallery-images-column gallery-img '. $class .'">';
	echo '<div class="list_image">';
	$i = 0;
	foreach ( $img_id as $key => $id ) {
		$class = '';
		$image_size = !empty($instance['image_size']) ? $instance['image_size'] : 'full';
		$image  =  wp_get_attachment_image($id, $image_size, array('alt' => get_the_title()));
		$image_url  =  wp_get_attachment_image_url($id, $image_size, array('alt' => get_the_title()));
		
		if ( isset($instance['popup_style']) && $instance['popup_style'] ) {
			$link_before = '<a href="' . esc_url( $image_url ) . '">';
			$after_link  = "</a>";

			if ( $key == ($columns - 1) ) {
				$extra_content = '<span class="button-gallery"><i aria-hidden="true" class="tk tk-th-large"></i> ' . esc_html__( 'Gallery', 'wp-hotel-booking' ) . '</span>';
			}
		}else {
			if ( $instance['image_link'] ) {
				if( !empty($img_url[$i]) ){
					$link_before = '<a ' . $t . ' href="' . esc_url( $img_url[$i] ) . '">';
					$after_link  = "</a>";
				}else {
					$link_before = '<a ' . $t . ' href="' . esc_url( $img_url[0] ) . '">';
					$after_link  = "</a>";
				}
			}
		}

		if ( $columns != 0 && $key >= $columns ){
			$class = 'hidden';
		}
		echo '<div class="item-image '. $class .'"' . $style_width . '>' . $link_before . $image . $after_link . $extra_content . "</div>";
		$i ++;
		$extra_content = '';
	}
	echo "</div>";
	echo '<div class="text_wellcome"><h3>' . $instance['text_show'] . '</h3></div>';
	echo "</div>";
}