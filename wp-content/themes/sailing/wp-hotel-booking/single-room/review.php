<?php
/**
 * The template for displaying single room review.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/single-room/review.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$rating   = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$settings = WPHB_Settings::instance();
?>

<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php echo get_avatar( $comment, apply_filters( 'hb_review_gravatar_size', '70' ), '' ); ?>

		<div class="comment-text">
			<!--            Review title-->
			
			<?php 
			if ( $settings->get( 'enable_advanced_review' ) === '1' ) {
				$review_title = get_comment_meta( $comment->comment_ID, 'hb_room_review_title', true );
					if ( ! empty( $review_title ) ) { ?>
					<h5 class="hb-room-review-title">
						<?php echo esc_html( $review_title ); ?>
					</h5>
				<?php } 
			}?>
			<?php if ( $comment->comment_approved == '0' ) : ?>

				<div class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'sailing' ); ?></em></div>

			<?php else : ?>

				<div class="meta">
					<h4 class="author" itemprop="author"><?php comment_author(); ?></h4>
					<div class="date" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( hb_date_format() ); ?></div>
				</div>

			<?php endif; ?>

			<?php if ( $rating && $settings->get( 'enable_review_rating' ) ) : ?>

				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'sailing' ), $rating ) ?>">
					<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"></span>
				</div>

			<?php endif; ?>

			<div itemprop="description" class="description"><?php comment_text(); ?></div>
			<!--Review Image-->
			<?php
			if ( $settings->get( 'enable_advanced_review' ) === '1' ) {
				$attachment_ids = get_comment_meta( get_comment_ID(), 'hb_room_review_images', true );
				if ( ! empty( $attachment_ids ) && is_array( $attachment_ids ) ) {
					?>
					<ul class="hb-room-review-images">
						<?php
						foreach ( $attachment_ids as $id ) {
							?>
							<li>
								<img src="<?php echo wp_get_attachment_image_url( $id ); ?>" alt="#">
							</li>
							<?php
						}
						?>
					</ul>
					<?php
				}
			}
			?>
		</div>
	</div>
</li>