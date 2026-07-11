<?php get_header(); ?>
<section class="main-herobanner">
  <div class="banner-txt-title">
<h4><?php the_title(); ?></h4>
</div>
<img src="<?php echo home_url(); ?>/wp-content/uploads/2024/02/inner-about-banner2.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
</div>
</section>

<section class="default-page-detail-section wow fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content();  ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); 
                    else: ?>
                <p>Sorry, no posts we're found.</p>
                <?php endif; ?>
             </div>
          </div>
    </div>
</section>  

<?php get_footer(); ?>