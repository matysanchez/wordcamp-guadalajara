<?php get_header(); ?>
<main id="content" class="archive">
    <div class="container has-content" id="container">
        <h1 class="title"><?php single_term_title(); ?></h1>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part('parts/single', 'header'); ?>
            <p><?php echo substr(get_the_excerpt(get_the_ID()), 0, 300); ?>... <a href="<?php echo get_permalink(get_the_ID()); ?>">Read More</a>.</p>
        </article>
        <?php endwhile; endif; ?>
        <div class="pagination">
            <?php matysanchez_pagination(); ?>
            <div class="clearfix"></div>
        </div>
    </div>
</main>
<script id="dsq-count-scr" src="//matias-sanchez-moises.disqus.com/count.js" async></script>
<?php get_footer(); ?>