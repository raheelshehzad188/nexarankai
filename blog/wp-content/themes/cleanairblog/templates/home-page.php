<?php
/*
* Template Name: Home
*/
?>
<?php get_header(); ?>
<?php if(have_posts()):while(have_posts()):the_post(); ?>
<section class="clean-air-insightsblog-mainhero">
  <div class="indiv-titlebx">
    <h4>Trending Insights</h4>
  </div>
  <img src="<?php echo home_url(); ?>/wp-content/uploads/2026/02/inner-blog-banner.jpg" class="dskban" alt="" title=""><img src="<?php echo home_url(); ?>/wp-content/uploads/2026/02/inner-blog-banner.jpg" class="mobban" alt="" title=""> </section>
<section class="clean-air-insights-postlist-section wow fadeInUp">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-12">
        <?php
		$query = new WP_Query(array(
		  'post_type'      => 'post',
		  'posts_per_page' => -1
		));

		if ($query->have_posts()) :
		  while ($query->have_posts()) : $query->the_post();
		?>

		 <?php include( locate_template( 'partials/content.php' ) ); ?>

		<?php
		  endwhile;
		  wp_reset_postdata();
		endif;
		?>
      </div>
      <div class="col-lg-3 col-md-12">
        <?php echo do_shortcode("[sidebar]"); ?>
      </div>
    </div>
  </div>
</section>

<?php endwhile; endif; ?>
<?php  get_footer(); ?>