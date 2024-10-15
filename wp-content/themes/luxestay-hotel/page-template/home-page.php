<?php
/**
 * Template Name: Home Page Template
 */
?>

<?php get_header(); ?>


<main id="content">
    

    <div id="content" class="page-container">

        <?php do_action( 'luxestay_hotel_before_banner-sectionone' ); ?>

        <?php get_template_part( 'template-parts/home-sections/banner-sectionone' ); ?>

        <?php do_action( 'luxestay_hotel_after_section_about' ); ?>

        <?php get_template_part( 'template-parts/home-sections/features-ameneties' ); ?>

        <?php do_action( 'luxestay_hotel_before_section1' ); ?>

        <?php get_template_part( 'template-parts/home-sections/about' ); ?>

        <?php do_action( 'luxestay_hotel_before_section1' ); ?>

        <?php get_template_part( 'template-parts/home-sections/section1' ); ?>

    </div>

</main>

<?php get_footer(); ?>
