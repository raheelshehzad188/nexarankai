<?php 
get_header(); 
$term = $wp_query->get_queried_object(); ?>

<section class="clean-air-insightsblog-mainhero">
  <div class="indiv-titlebx">
    <h4><?php echo $term->name; ?></h4>
  </div>
  <img src="<?php echo home_url(); ?>/wp-content/uploads/2026/02/inner-blog-banner.jpg" class="dskban" alt="" title=""><img src="<?php echo home_url(); ?>/wp-content/uploads/2026/02/inner-blog-banner.jpg" class="mobban" alt="" title=""> </section>
<section class="clean-air-insights-postlist-section wow fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <?php
                        if (have_posts()): $i=0; while (have_posts()):
                        the_post();
                        $title=get_the_title();
                        $featured=wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                        $date=get_the_date('F d, Y' );
                        $author=get_author_name();
                         $link=get_permalink($post->ID);
                        ?>
                        <?php include( locate_template( 'partials/content.php' ) ); ?>
                    <?php endwhile; ?>
                    <?php if (function_exists("pagination")) {
                        pagination();
                    } ?>
                    <?php wp_reset_postdata(); 
                endif; ?>
            </div>
            <div class="col-lg-3 col-md-12">                
                     <?php echo do_shortcode("[sidebar]"); ?>                
            </div>
        </div>
    </div>
</section>
</section>    
<?php get_footer(); ?>	        
