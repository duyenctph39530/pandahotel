<?php
/**
 * The template for displaying new customer form in checkout page.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/checkout/customer-new.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $customer
 */
?>
<div class="hb-order-new-customer" id="hb-order-new-customer">
	<div class="hb-col-padding hb-col-border">
		<h4><?php _e( 'Khách hàng mới', 'sailing' ); ?></h4>
		<ul class="hb-form-table col-2">
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Title', 'sailing' ); ?>
					<span class="hb-required">*</span> </label>

				<div class="hb-form-field-input">
					<?php hb_dropdown_titles( array( 'selected' => $customer->title ) ); ?>
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Tên', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="text" name="first_name" value="<?php echo esc_attr( $customer->first_name ); ?>" placeholder="<?php _e( 'Tên *', 'sailing' ); ?>" required />
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Họ', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="text" name="last_name" value="<?php echo esc_attr( $customer->last_name ); ?>" placeholder="<?php _e( 'Họ*', 'sailing' ); ?>" required />
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Địa chỉ', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="text" name="address" value="<?php echo esc_attr( $customer->address ); ?>" placeholder="<?php _e( 'Địa chỉ *', 'sailing' ); ?>" required />
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Tỉnh/Thành phố', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="text" name="city" value="<?php echo esc_attr( $customer->city ); ?>" placeholder="<?php _e( 'Tỉnh/Thành phố *', 'sailing' ); ?>" required />
				</div>
			</li>
		</ul>
		<ul class="hb-form-table col-2">
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Mã bưu chính', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="text" name="postal_code" value="<?php echo esc_attr( $customer->postal_code ); ?>" placeholder="<?php _e( 'Mã bưu chính *', 'sailing' ); ?>" required />
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Quốc gia', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<?php hb_dropdown_countries( array( 'name'             => 'country',
					                                    'show_option_none' => __( 'Quốc gia *', 'sailing' ),
					                                    'selected'         => $customer->country
					) ); ?>
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Số điện thoại', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="text" name="phone" value="<?php echo esc_attr( $customer->phone ); ?>" placeholder="<?php _e( 'Số điện thoại*', 'sailing' ); ?>" required />
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Email', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="email" name="email" value="<?php echo esc_attr( $customer->email ); ?>" placeholder="<?php _e( 'Địa chỉ Email*', 'sailing' ); ?>" required />
				</div>
			</li>
			<li class="hb-form-field">
				<label class="hb-form-field-label"><?php _e( 'Quận/Huyện', 'sailing' ); ?>
					<span class="hb-required">*</span></label>

				<div class="hb-form-field-input">
					<input type="text" name="state" value="<?php echo esc_attr( $customer->state ); ?>" placeholder="<?php _e( 'Quận/ Huyện *', 'sailing' ); ?>" required />
				</div>
			</li>
		</ul>
		<input type="hidden" name="existing-customer-id" value="" />
	</div>
</div>