<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bosa Hotel
 */
?>

<?php
	$bosa_hotel_stickyClass = "col-12";
	$bosa_hotel_layout_class = '';
	if( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ) {
		if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' ){
			$bosa_hotel_stickyClass = "col-sm-6 grid-post";
			if( !is_active_sidebar( 'right-sidebar') ){
				$bosa_hotel_stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' ){
			$bosa_hotel_stickyClass = "col-sm-6 grid-post";
			if( !is_active_sidebar( 'left-sidebar') ){
				$bosa_hotel_stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ) {
		if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' ){
			$bosa_hotel_stickyClass = "col-sm-6 col-lg-4 grid-post";
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' ){
			$bosa_hotel_stickyClass = "col-sm-6 col-lg-6 grid-post";
			if( !is_active_sidebar( 'left-sidebar') && !is_active_sidebar( 'right-sidebar') ){
				$bosa_hotel_stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}
	if( get_theme_mod( 'disable_sidebar_blog_page', false ) && get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' ){
		$bosa_hotel_stickyClass = "col-sm-6 col-lg-4 grid-post";
	}

	if( get_theme_mod( 'archive_post_layout', 'single' ) == 'list' ){
		$bosa_hotel_layout_class = 'list-post';
	}elseif( get_theme_mod( 'archive_post_layout', 'single' ) == 'single' ){
		$bosa_hotel_layout_class = 'single-post';
	}

	$bosa_hotel_class = '';
	if(!has_post_thumbnail()){
		$bosa_hotel_class = 'no-thumbnail';
	}

?>
<div class="<?php echo esc_attr( $bosa_hotel_stickyClass );?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $bosa_hotel_class . ' ' . $bosa_hotel_layout_class ) ?> >
		<?php 
		
		if ( has_post_thumbnail() ) : ?>
	        <figure class="featured-image">
	            <a href="<?php the_permalink(); ?>">
	                <?php
	                $bosa_hotel_grid_list_size = 'bosa-hotel-420-300';
	                $bosa_hotel_single_size 	= 'bosa-hotel-1370-550';
	                $bosa_hotel_render_post_image_size = get_theme_mod( 'render_post_image_size', '' );
	                if ( !empty( $bosa_hotel_render_post_image_size ) ){
	                	$bosa_hotel_grid_list_size = $bosa_hotel_render_post_image_size;
	                	$bosa_hotel_single_size 	= $bosa_hotel_render_post_image_size;
	                }
	                if( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'single' ) == 'list' ){
	                		bosa_hotel_image_size( $bosa_hotel_grid_list_size );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'single' ) == 'single' ){
	                		bosa_hotel_image_size( $bosa_hotel_single_size );
	                	}
	                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'single' ) == 'list' ){
	                		bosa_hotel_image_size( $bosa_hotel_grid_list_size );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'single' ) == 'single' ){
	                		bosa_hotel_image_size( $bosa_hotel_single_size );
	                	}
	                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'single' ) == 'list' ){
	                		bosa_hotel_image_size( $bosa_hotel_grid_list_size );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'single' ) == 'single' ){
	                		bosa_hotel_image_size( $bosa_hotel_single_size );
	                	}
	                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'single' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'single' ) == 'list' ){
	                		bosa_hotel_image_size( $bosa_hotel_grid_list_size );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'single' ) == 'single' ){
	                		bosa_hotel_image_size( $bosa_hotel_single_size );
	                	}
	                }
	                ?>
	            </a>
	        </figure><!-- .recent-image -->
		<?php
	    endif;
		?>
	    <div class="entry-content">
	    	<header class="entry-header">
				<?php 
					if( !get_theme_mod( 'hide_category', false ) ){
						bosa_hotel_entry_header();
					}
					if( !get_theme_mod( 'hide_post_title', false ) ){
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					}
				?>

			</header><!-- .entry-header -->
			<div class="entry-meta">
	           <?php bosa_hotel_entry_footer(); ?>
	        </div><!-- .entry-meta -->
			
			<?php if ( !get_theme_mod( 'hide_blog_page_excerpt', false ) || !get_theme_mod( 'hide_post_button', true ) ){ ?>
		        <div class="entry-text">
					<?php
						if ( !get_theme_mod( 'hide_blog_page_excerpt', false ) ){
							$bosa_hotel_excerpt_length = get_theme_mod( 'post_excerpt_length', 15 );
							bosa_hotel_excerpt( $bosa_hotel_excerpt_length , true );
						}
					?>
					<?php 
						if( !get_theme_mod( 'hide_post_button', true ) ){
							$bosa_hotel_post_btn_defaults = array(
								array(
									'blog_btn_type' 		=> 'button-text',
									'blog_btn_bg_color'		=> '#C9A76E',
									'blog_btn_border_color'	=> '#1a1a1a',
									'blog_btn_text_color'	=> '#1a1a1a',
									'blog_btn_hover_color'	=> '#E4A853',
									'blog_btn_text' 		=> '',
									'blog_btn_radius'		=> 0,
								),		
							);
							$bosa_hotel_post_button = get_theme_mod( 'blog_page_button_repeater', $bosa_hotel_post_btn_defaults );
							if( !empty( $bosa_hotel_post_button ) && is_array( $bosa_hotel_post_button ) ){ ?>
								<div class="button-container">
									<?php
									  	$bosa_hotel_count = 0.2;
					            		foreach( $bosa_hotel_post_button as $bosa_hotel_value ){
											if( !empty( $bosa_hotel_value['blog_btn_text'] ) ){ ?>
												<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $bosa_hotel_value['blog_btn_type'] ); ?>">
													<?php 
														echo esc_html( $bosa_hotel_value['blog_btn_text'] );
													?>
												</a>
												<?php
								                $bosa_hotel_count = $bosa_hotel_count + 0.2;
								            }
							        	}
							        ?>
							    </div>
							    <?php
					        }
						}
					?>	
				</div>
			<?php } ?>
		</div><!-- .entry-content -->
	</article><!-- #post-->
</div>