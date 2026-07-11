<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */
?>
           
<div class="clean-air-bloginsightspost">
  <div class="ltimgbx">
    <a href="<?php the_permalink(); ?>">
      <img 
        src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>"
        alt="<?php echo esc_attr(get_the_title()); ?>"
        title="<?php echo esc_attr(get_the_title()); ?>"
      >
    </a>
  </div>

  <div class="rtdscbx">
    <h2><?php the_title(); ?></h2>
    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>

    <div class="btnbx">
      <div class="morebtn">
        <a href="<?php the_permalink(); ?>">Read More</a>
      </div>
      <div class="dtebx"><?php echo get_the_date('F d, Y'); ?></div>
    </div>
  </div>
</div>