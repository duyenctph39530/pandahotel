<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Hotel
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-hotel' ) ) );
		echo esc_html( date('Y') );
		printf( esc_html__( ' Bosa Hotel. Powered by', 'bosa-hotel' ) );
	?>
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bosa-hotel' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'WordPress', 'bosa-hotel' ) );
		?>
	</a>
</div><!-- .site-info -->