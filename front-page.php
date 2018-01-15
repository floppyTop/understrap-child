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
    // WooCommerce Queries
    $params = array(
        'posts_per_page' => 5,
        'post_type' => 'product',
        'product_cat' => 'Featured',        
        'order_by' => 'post_title',
        'order' => 'ASC'
    );
    $wc_query = new WP_Query($params);
?>



<div class="hero">
    <div id="hero-one" style="background-image: linear-gradient(36.48deg, rgba(33, 33, 33, .0) 0%, rgba(216,216,216,0.2) 100%), url('<?php echo $heroBG1['url']?>')">
            <a href=""><h1 class="hero-heading one"><?php the_field('headline_1') ?></h1></a>
    </div>
    <div id="hero-two" style="background-image: linear-gradient(36.48deg, rgba(33, 33, 33, .0) 0%, rgba(216,216,216,0.2) 100%), url(' <?php echo $heroBG2['url'] ?>')">
            <a href=""><h1 class="hero-heading two"><?php the_field('headline_2') ?></h1></a>
    </div>
    <?php
    if( !empty($introIcon) ): ?>
            <img class="icon" src="<?php echo $introIcon['url']; ?>" alt="<?php echo $introIcon['alt']; ?>">
    <?php endif; ?>
</div>

<section class="intro">
    <div class="inner">
    <h2 class="intro"><?php the_field('intro_heading') ?></h2>
    <p class="intro-text"><?php echo $introText; ?></p>
    </div>
</section>

<section class="featured-categories">
    <div class="inner">
        <?php if ($wc_query->have_posts()) : ?>
        <div class="slick-slider">  
        <?php while ($wc_query->have_posts()) :
                $wc_query->the_post(); ?>
            
            <div class="slick-slide">
                <?php the_post_thumbnail('full'); ?>
                <div class="bar">
                <h3 class="featured-product-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title();?>
                    </a>
                </h3>
                <h3>
                    <a class="view" href="<?php the_permalink(); ?>">View</a>
                </h3>
                </div>
        </div>
        <?php endwhile; ?>
        </div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php else: ?>
        <p>
            <?php _e( 'No Products' ); ?>
        </p>
        <?php endif; ?>
</section>

<?php
    get_footer();
?>