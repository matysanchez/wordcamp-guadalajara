<?php get_header(); ?>
<main id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="searchpage">
                <div class="container has-content" id="container">
                    <h1 class="title"><?php printf(esc_html__('Search Results for: %s', 'matysanchez'), get_search_query()); ?></h1>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php get_template_part('parts/single', 'header'); ?>
                        <p><?php echo substr(get_the_excerpt(get_the_ID()), 0, 300); ?>... <a href="<?php echo get_permalink(get_the_ID()); ?>">Read More</a>.</p>
                    </article>
                    <div class="pagination">
                        <?php matysanchez_pagination(); ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        <?php endwhile;
        else : ?>
        <div class="container">
            <article id="post-0" class="post not-found">
                <header class="header">
                    <h1 class="entry-title"><?php esc_html_e('Nothing Found', 'matysanchez'); ?></h1>
                </header>
                <div class="entry-content">
                    <p><?php esc_html_e('Sorry, nothing matched your search. Please try again.', 'matysanchez'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </article>
        </div>
    <?php endif; ?>
</main>
<script id="dsq-count-scr" src="//matias-sanchez-moises.disqus.com/count.js" async></script>
<?php get_footer(); ?>