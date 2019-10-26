<?php /* Template Name: Portfolio Listing */ ?>
<?php
$args = array(
    'orderby' => 'post_id',
    'order' => 'ASC',
    'post_type' => 'portfolios',
    'post_status' => 'publish',
);
query_posts($args);
?>
<?php get_header(); ?>
<main id="content" class="category">
    <div class="container has-content" id="container">
        <h1 class="title">Portfolio</h1>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php include(locate_template('parts/portfolio-fields.php', false, false));  ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php get_template_part('parts/portfolio', 'header'); ?>
                    <p><?php echo substr(get_the_excerpt(get_the_ID()), 0, 500); ?></p>
                    <a class="cta" href="<?php echo get_permalink(get_the_ID()); ?>">Read More</a>
                </article>
        <?php endwhile;
        endif; ?>
    </div>
</main>
<?php get_footer(); ?>