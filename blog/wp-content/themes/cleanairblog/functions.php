<?php

/* Enqueue Styles */
if (!function_exists('custom_enqueue_styles')) {
    function custom_enqueue_styles() {
        wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css');
        wp_enqueue_style('custom-responsive', get_template_directory_uri() . '/assets/css/responsive.css');
    }
    add_action('wp_enqueue_scripts', 'custom_enqueue_styles');
}


add_action( 'after_setup_theme', 'themes_setup' );
if ( ! function_exists( 'themes_setup' ) ) {
	function themes_setup () {

        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
	}
}

/* Register Menu */
function custom_new_menu() {
    register_nav_menus(
        array('header-menu' => __('Header Menu'),
        'mobile-menu' => __('Mobile Menu'))
        );
}
add_action('init', 'custom_new_menu');
/* Logo */
add_theme_support('custom-logo',array('height' => 100, 'width' => 400, 'flex-height' => true, 'flex-width' => true, 'header-text' => array('site-title', 'site-description'),));

function theme_widjet() {
        
    register_sidebar(array('name' => __('Footer 1', 'wpb'), 
    'id' => 'footer1',
    'description' => __('Appears on footer', 'wpb'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>', 
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',));
    
    register_sidebar(array('name' => __('Footer 2', 'wpb'), 
    'id' => 'footer2',
    'description' => __('Appears on footer', 'wpb'), 
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>', 
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',));
    
    register_sidebar(array('name' => __('Footer 3', 'wpb'),
    'id' => 'footer3',
    'description' => __('Appears on footer', 'wpb'), 
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widget-title">', 
    'after_title' => '</h4>',));
    
    register_sidebar(array('name' => __('Footer 4', 'wpb'),
    'id' => 'footer4',
    'description' => __('Appears on footer', 'wpb'), 
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widget-title">', 
    'after_title' => '</h4>',));    
    
    register_sidebar(array('name' => __('Header Right', 'wpb'),
    'id' => 'rightheader', 
    'description' => __('Appears on Header', 'wpb'), 
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>', 
    'before_title' => '<h3 class="widget-title">', 
    'after_title' => '</h3>',));
    
    register_sidebar(array('name' => __('Floating Buttons', 'wpb'),
    'id' => 'floatingbuttons', 
    'description' => __('Appears on Footer', 'wpb'), 
    'before_widget' => '<div id="%1$s" class="warranty-bar">',
    'after_widget' => '</div>', 
    'before_title' => '<h3 class="widget-title">', 
    'after_title' => '</h3>',));
    
     
    
}
add_action('widgets_init', 'theme_widjet');

function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;
 
    global $paged;
    if(empty($paged)) $paged = 1;
 
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
 
    if(1 != $pages)
    {
        echo "<div class=\"pagination\">";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }
 
        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}

add_filter( 'excerpt_length', function(){
	return 20;
} );

add_filter('excerpt_more', function($more) {
	return '...';
});

/* Remove p from contact form 7 */

add_filter('wpcf7_autop_or_not', '__return_false');

function acf_wysiwyg_remove_wpautop() {
  // remove p tags //
  //remove_filter('acf_the_content', 'wpautop' );
  // add line breaks before all newlines //
  remove_filter( 'acf_the_content', 'nl2br' );
}

add_action('acf/init', 'acf_wysiwyg_remove_wpautop');

function activesidebar() { ?>
<div class="recentpost-clean-air">
    <h3>Recent Posts</h3>
    <ul>
        <?php
            $args=array(
                'post_type'=>'post',
                'posts_per_page' => 11,
                'post_status'=>'publish',
                'order'=>'DEC'
                );
                        
            $query= new WP_Query($args);
            if ($query->have_posts()): $i=0; while ($query->have_posts()):
                $query->the_post();
                $title=get_the_title();
                $link=get_permalink();?>
        <li><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); 
                            endif;
                        ?>
    </ul>
</div>
<div class="categoriespost-clean-air">
    <h3>Categories</h3>
    <ul>
        <?php wp_list_categories( array(
                    		'orderby'    => 'name',
                    		'show_count' => false,
                    		'title_li' => '',
                    		) ); ?>
    </ul>
</div>
<?php }
// register shortcode
add_shortcode('sidebar', 'activesidebar');