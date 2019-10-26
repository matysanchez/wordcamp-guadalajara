<?php get_header(); ?>
<main id="content" class="single">
    <?php if ( has_post_thumbnail() ) { ?>
    <div class="cover" style="background-image: url(<?php echo the_post_thumbnail_url( 'full' ); ?>);">
    </div>
    <?php } ?>
    <div class="container has-content" id="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part('parts/single', 'header'); ?>
            <?php the_content(); ?>
            <?php get_template_part('parts/single', 'footer'); ?>
        </article>
        <?php if (comments_open() && !post_password_required()) {
            get_template_part('parts/comments');
        }
        endwhile; endif; ?>
    </div>
</main>
<script id="dsq-count-scr" src="//matias-sanchez-moises.disqus.com/count.js" async></script>
<?php get_footer(); ?>