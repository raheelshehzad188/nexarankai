<?php get_header(); ?>
<section class="clean-air-insightsblog-mainhero">
  <div class="indiv-titlebx">
    <h4>Trending Insights</h4>
  </div>
  <img src="<?php echo home_url(); ?>/wp-content/uploads/2026/02/inner-blog-banner.jpg" class="dskban" alt="" title=""><img src="<?php echo home_url(); ?>/wp-content/uploads/2026/02/inner-blog-banner.jpg" class="mobban" alt="" title="">
  </section>
<section class="clean-air-insights-postlist-section wow fadeInUp">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-12">
        <div class="clean-air-post-details">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
                $imgurl=wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                $title = get_the_title();
                ?>
          <div class="dtebx"><?php echo get_the_date('F d, Y'); ?></div>
          <h1><?php echo $title; ?></h1>
          <img src="<?php echo $imgurl; ?>" class="alignright" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
         <?php the_content(); ?>
                <?php endwhile; else: ?>
                <p>Sorry, no posts we're found.</p>
                <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-3 col-md-12">
        <?php echo do_shortcode("[sidebar]"); ?>
      </div>
    </div>
  </div>
</section> 
<?php if(get_field('faq')){ ?>
<section class="faqstab-pgetxt-section">
  <div class="container"><h3>FAQ</h3>
    <div class="row">
      <div class="col-lg-1 col-md-12"></div>
      <div class="col-lg-10 col-md-12">
        <div class="accordion" id="accordionExample">
          <?php echo get_field('faq'); ?>
        </div>
      </div>
      <div class="col-lg-1 col-md-12"></div>
    </div>
  </div>
</section> 
<?php } ?>
<?php get_footer(); ?>	