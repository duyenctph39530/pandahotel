<?php
/**
 * View for displaying payment settings in admin
 *
 * @author   ThimPress
 * @package  WP-Hotel-Booking/Stripe/View
 * @version  1.7.3
 */

$settings = WPHB_Settings::instance();
$stripe   = $settings->get( 'stripe' );
$stripe   = wp_parse_args(
	$stripe,
	array(
		'enable'             => 'on',
		'test_secret_key'    => '',
		'test_publish_key'   => '',
		'live_secret_key'    => '',
		'live_publish_key'   => '',
		'test_mode'          => 'on',
		'checkout_on_stripe' => 'on',
	)
);

$field_name = $settings->get_field_name( 'stripe' );
?>

<table class="form-table">
	<tr>
		<th><?php _e( 'Enable', 'wp-hotel-booking-stripe' ); ?></th>
		<td>
			<input type="hidden" name="<?php echo esc_attr( $field_name ); ?>[enable]" value="off" />
			<input type="checkbox" name="<?php echo esc_attr( $field_name ); ?>[enable]" <?php checked( $stripe['enable'] == 'on' ? 1 : 0, 1 ); ?> value="on" />
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Checkout options', 'wp-hotel-booking-stripe' ); ?></th>
		<td>
			<input type="hidden" name="<?php echo esc_attr( $field_name ); ?>[checkout_on_stripe]" value="off" />
			<input type="checkbox" name="<?php echo esc_attr( $field_name ); ?>[checkout_on_stripe]" <?php checked( $stripe['checkout_on_stripe'] == 'on' ? 1 : 0, 1 ); ?> value="on" />
			<span class="description"><?php _e( 'Redirect Payment to Stripe Page', 'wp-hotel-booking-stripe' ); ?></span>
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Test Mode Enable', 'wp-hotel-booking-stripe' ); ?></th>
		<td>
			<input type="hidden" name="<?php echo esc_attr( $field_name ); ?>[test_mode]" value="off" />
			<input type="checkbox" name="<?php echo esc_attr( $field_name ); ?>[test_mode]" <?php checked( $stripe['test_mode'] == 'on' ? 1 : 0, 1 ); ?> value="on" />
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Test Secret Key', 'wp-hotel-booking-stripe' ); ?></th>
		<td>
			<input type="text" name="<?php echo esc_attr( $field_name ); ?>[test_secret_key]" value="<?php echo esc_attr( $stripe['test_secret_key'] ); ?>" />
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Test Publishable Key', 'wp-hotel-booking-stripe' ); ?></th>
		<td>
			<input type="text" name="<?php echo esc_attr( $field_name ); ?>[test_publish_key]" value="<?php echo esc_attr( $stripe['test_publish_key'] ); ?>" />
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Live Secret Key', 'wp-hotel-booking-stripe' ); ?></th>
		<td>
			<input type="text" class="regular-text" name="<?php echo esc_attr( $field_name ); ?>[live_secret_key]" value="<?php echo esc_attr( $stripe['live_secret_key'] ); ?>" />
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Live Publishable Key', 'wp-hotel-booking-stripe' ); ?></th>
		<td>
			<input type="text" class="regular-text" name="<?php echo esc_attr( $field_name ); ?>[live_publish_key]" value="<?php echo esc_attr( $stripe['live_publish_key'] ); ?>" />
		</td>
	</tr>
</table>
