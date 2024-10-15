<?php
$image_size = !empty($instance['image_size']) ? $instance['image_size'] : 'thumbnail'; 
if ( $instance['image_link'] ) {
	$link_before = '<a target="' . $instance['link_target'] . '" href="' . esc_url($instance['image_link']) . '">';
	$after_link  = "</a>";
}else{
	$link_before = '';
	$after_link = '';
}

?>
<div class="box_image style_1">
	<?php echo ent2ncr($link_before); ?>
	<div class="image">
		<div class="row">
			<div class="image-left col-md-6 col-sm-6">
				<?php
					echo wp_get_attachment_image($instance['image_left'], $image_size, array('alt' => get_the_title()));
				 ?>
			</div>
			<div class="image-right col-md-6 col-sm-6">
				<?php
					echo wp_get_attachment_image($instance['image_right'], $image_size, array('alt' => get_the_title()));
				?>
			</div>
		</div>
	</div>
	<div class="image_background">
		<?php
			echo wp_get_attachment_image($instance['image_background'], $image_size, array('alt' => get_the_title()));
		?>
	</div>
	<?php echo ent2ncr($after_link); ?>
</div>

