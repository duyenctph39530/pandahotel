<?php
/**
 * Template part for displaying posts
 *
 * @package Luxury Hotels
 * @subpackage luxury_hotels
 */

?>
<?php $luxury_hotels_column_layout = get_theme_mod( 'luxury_hotels_sidebar_post_layout');
if($luxury_hotels_column_layout == 'four-column' || $luxury_hotels_column_layout == 'three-column' ){ ?>
  <div id="category-post">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="page-box box-image">
         <?php
            // Get the post content
            $luxury_hotels_post_content = apply_filters('the_content', get_the_content());

            // Create a DOMDocument to parse the HTML content
            $dom = new DOMDocument();
            @$dom->loadHTML($luxury_hotels_post_content);

            // Find and display the first image in the post content
            $images = $dom->getElementsByTagName('img');

            echo ($images->length > 0)
                ? '<img src="' . esc_url($images->item(0)->getAttribute('src')) . '">'
                : '';
          ?>
          <div class="box-content mt-2 text-center">
              <h4><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h4>
            <div class="box-info">
              <?php $luxury_hotels_blog_archive_ordering = get_theme_mod('blog_meta_order', array('date', 'author', 'comment', 'category'));
              foreach ($luxury_hotels_blog_archive_ordering as $luxury_hotels_blog_data_order) : 
                if ('date' === $luxury_hotels_blog_data_order) : ?>
                  <i class="far fa-calendar-alt mb-1"></i><span class="entry-date"><?php echo get_the_date('j F, Y'); ?></span>
                <?php elseif ('author' === $luxury_hotels_blog_data_order) : ?>
                  <i class="fas fa-user mb-1"></i><span class="entry-author"><?php the_author(); ?></span>
                <?php elseif ('comment' === $luxury_hotels_blog_data_order) : ?>
                  <i class="fas fa-comments mb-1"></i><span class="entry-comments"><?php comments_number(__('0 Comments', 'luxury-hotels'), __('0 Comments', 'luxury-hotels'), __('% Comments', 'luxury-hotels')); ?></span>
                <?php elseif ('category' === $luxury_hotels_blog_data_order) :?>
                  <i class="fas fa-list mb-1"></i><span class="entry-category"><?php luxury_hotels_display_post_category_count(); ?></span>
                <?php endif;
              endforeach; ?>
            </div>
            <p><?php echo esc_html(luxury_hotels_excerpt_function());?></p>
            <?php if(get_theme_mod('luxury_hotels_remove_read_button',true) != ''){ ?>
              <div class="readmore-btn">
                <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More', 'luxury-hotels' ); ?>"><?php echo esc_html(get_theme_mod('luxury_hotels_read_more_text',__('Read More','luxury-hotels')));?></a>
              </div>
            <?php }?>
          </div>
          <div class="clearfix"></div>
      </div>
    </article>
  </div>
<?php } else{ ?>
<div id="category-post">
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="page-box row">
      <?php $luxury_hotels_post_layout = get_theme_mod( 'luxury_hotels_post_layout','image-content');
      if($luxury_hotels_post_layout == 'image-content'){ ?>
        <div class="box-image col-lg-6 col-md-12 align-self-center">
          <?php
            // Get the post content
            $luxury_hotels_post_content = apply_filters('the_content', get_the_content());

            // Create a DOMDocument to parse the HTML content
            $dom = new DOMDocument();
            @$dom->loadHTML($luxury_hotels_post_content);

            // Find and display the first image in the post content
            $images = $dom->getElementsByTagName('img');

            echo ($images->length > 0)
                ? '<img src="' . esc_url($images->item(0)->getAttribute('src')) . '">'
                : '';
            ?>
        </div>
        <div class="box-content col-lg-6 col-md-12">
          <h4><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h4>
          <div class="box-info">
            <?php $luxury_hotels_blog_archive_ordering = get_theme_mod('blog_meta_order', array('date', 'author', 'comment', 'category'));
            foreach ($luxury_hotels_blog_archive_ordering as $luxury_hotels_blog_data_order) : 
              if ('date' === $luxury_hotels_blog_data_order) : ?>
                <i class="far fa-calendar-alt mb-1"></i><span class="entry-date"><?php echo get_the_date('j F, Y'); ?></span>
              <?php elseif ('author' === $luxury_hotels_blog_data_order) : ?>
                <i class="fas fa-user mb-1"></i><span class="entry-author"><?php the_author(); ?></span>
              <?php elseif ('comment' === $luxury_hotels_blog_data_order) : ?>
                <i class="fas fa-comments mb-1"></i><span class="entry-comments"><?php comments_number(__('0 Comments', 'luxury-hotels'), __('0 Comments', 'luxury-hotels'), __('% Comments', 'luxury-hotels')); ?></span>
              <?php elseif ('category' === $luxury_hotels_blog_data_order) :?>
                <i class="fas fa-list mb-1"></i><span class="entry-category"><?php luxury_hotels_display_post_category_count(); ?></span>
              <?php endif;
            endforeach; ?>
          </div>
          <p><?php echo esc_html(luxury_hotels_excerpt_function());?></p>
          <?php if(get_theme_mod('luxury_hotels_remove_read_button',true) != ''){ ?>
            <div class="readmore-btn">
              <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More', 'luxury-hotels' ); ?>"><?php echo esc_html(get_theme_mod('luxury_hotels_read_more_text',__('Read More','luxury-hotels')));?></a>
            </div>
          <?php }?>
        </div>
      <?php }
      else if($luxury_hotels_post_layout == 'content-image'){ ?>
        <div class="box-content col-lg-6 col-md-12">
          <h4><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h4>
          <div class="box-info">
            <?php $luxury_hotels_blog_archive_ordering = get_theme_mod('blog_meta_order', array('date', 'author', 'comment', 'category'));
            foreach ($luxury_hotels_blog_archive_ordering as $luxury_hotels_blog_data_order) : 
              if ('date' === $luxury_hotels_blog_data_order) : ?>
                <i class="far fa-calendar-alt mb-1"></i><span class="entry-date"><?php echo get_the_date('j F, Y'); ?></span>
              <?php elseif ('author' === $luxury_hotels_blog_data_order) : ?>
                <i class="fas fa-user mb-1"></i><span class="entry-author"><?php the_author(); ?></span>
              <?php elseif ('comment' === $luxury_hotels_blog_data_order) : ?>
                <i class="fas fa-comments mb-1"></i><span class="entry-comments"><?php comments_number(__('0 Comments', 'luxury-hotels'), __('0 Comments', 'luxury-hotels'), __('% Comments', 'luxury-hotels')); ?></span>
              <?php elseif ('category' === $luxury_hotels_blog_data_order) :?>
                <i class="fas fa-list mb-1"></i><span class="entry-category"><?php luxury_hotels_display_post_category_count(); ?></span>
              <?php endif;
            endforeach; ?>
          </div>
          <p><?php echo esc_html(luxury_hotels_excerpt_function());?></p>
          <?php if(get_theme_mod('luxury_hotels_remove_read_button',true) != ''){ ?>
            <div class="readmore-btn">
              <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More', 'luxury-hotels' ); ?>"><?php echo esc_html(get_theme_mod('luxury_hotels_read_more_text',__('Read More','luxury-hotels')));?></a>
            </div>
          <?php }?>
        </div>
        <div class="box-image col-lg-6 col-md-12 align-self-center pt-lg-0 pt-3">
          <?php
            // Get the post content
            $luxury_hotels_post_content = apply_filters('the_content', get_the_content());

            // Create a DOMDocument to parse the HTML content
            $dom = new DOMDocument();
            @$dom->loadHTML($luxury_hotels_post_content);

            // Find and display the first image in the post content
            $images = $dom->getElementsByTagName('img');

            echo ($images->length > 0)
                ? '<img src="' . esc_url($images->item(0)->getAttribute('src')) . '">'
                : '';
            ?>
        </div>
      <?php }?>
      <div class="clearfix"></div>
    </div>
  </article>
</div>
<?php } ?>