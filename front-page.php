<?php
    get_header();
?>

<?php
    // Hero Vars
    $heroBG1 = get_field('hero_image_one');
    $heroBG2 = get_field('hero_image_two');
    $heroHeadline2  = get_field('hero_headline_2');
    // Intro Vars
    $introIcon      = get_field('intro_icon');
    $iconSize       = 'full';
    $introHeadline  = get_field('intro_heading');
    $introText = get_field('intro_text');
    $categorySelect = get_field('category_select');
    // END ACF VAR

    // WooCommerce Queries
    // $params = array(
    //     'posts_per_page' => 5,
    //     'post_type' => 'product',
    //     'product_cat' => 'Featured',        
    //     'order_by' => 'post_title',
    //     'order' => 'ASC'
    // );
    
    // $wc_query = new WP_Query($params);
    // global $wp_query;

    $term_id = 16;
    $taxonomy_name = 'product_cat';
    $term_children = get_term_children( $term_id, $taxonomy_name );
    $args = array(
        'numberposts' => 10,
        'offset'      => 0,
        'category'    => 0,
        'orderby'     => 'post_date',
        'order'       => 'DESC',
        'include'     => '',
        'exclude'     => '',
        'meta_key'    => '',
        'meta_value'  =>'',
        'post_type'   => 'post',
        'post_status' => 'publish, future, draft',
        'suppress_filters' => true
    );
    
    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );

    
?>



<div class="hero">
    <div id="hero-one" style="background-image: linear-gradient(36.48deg, rgba(33, 33, 33, .0) 0%, rgba(216,216,216,0.2) 100%), url('<?php echo $heroBG1['url']?>')">
            <a href=""><h2 class="hero-heading one"><?php the_field('headline_1') ?></h2></a>
    </div>
    <div id="hero-two" style="background-image: linear-gradient(36.48deg, rgba(33, 33, 33, .0) 0%, rgba(216,216,216,0.2) 100%), url(' <?php echo $heroBG2['url'] ?>')">
            <a href=""><h2 class="hero-heading two"><?php the_field('headline_2') ?></h2></a>
    </div>
    <?php
    if( !empty($introIcon) ): ?>
            <img class="icon" src="<?php echo $introIcon['url']; ?>" alt="<?php echo $introIcon['alt']; ?>">
    <?php endif; ?>
</div>

<section class="intro content">
    <div class="inner">
    <h1 class="intro"><?php the_field('intro_heading') ?></h1>
    <p class="intro-text"><?php echo $introText; ?></p>
    </div>
</section>

<section class="featured-categories content">
    <div class="inner">

        <?php if (!empty ($term_children)) : ?>
            <h2>Featured Enhancements</h2>
            <div class="slick-slider">

            <?php foreach   (   $term_children as $child    ) {
                $term = get_term_by( 'id', $child, $taxonomy_name );
                $thumb_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                echo '<div class="slick-slide">';
                echo '<img src="' . wp_get_attachment_url(  $thumb_id, 'medium'   ) . '"/>';
                echo '<div class="bar">'; 
                echo '<h3 class="featured-product-title"><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></h3>';
                echo '<h3><a class="view" href="' . get_term_link( $child, $taxonomy_name ) . '">' . 'View' . '</a></h3>';
                echo '</div>';
                echo '</div>';
            } ?>

        </div>

    </div>
        <?php wp_reset_postdata(); ?>
        <?php else: ?>

        <p>
            <?php _e( 'No Products' ); ?>
        </p>

        <?php endif; ?>
</section>

<section class="recent-posts content">
    <div class="inner">
        <h2>Recent Blog Posts</h2>
        <?php
            echo '<div class="slick-slider">';
            
	        foreach ( $recent_posts as $recent )    {
                $content_post   =   get_post($recent["ID"]);
                $content = $content_post->post_content;
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]&gt', $content);

                echo '<div class="slick-slide">';
                        echo    '<h3 class="recent-post-title"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a></h3>';
                        echo    '<p>' . substr($content, 0, 200) . ' <a href="' . get_permalink($recent["ID"]) . '"> [...]</a></p>';
                echo '</div>'; 
            }

            echo '</div>';
            
	        wp_reset_query();
?>
    </div>
</section>

<?php
    get_footer();
?>