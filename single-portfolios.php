<?php include(locate_template('parts/portfolio-fields.php', false, false));  ?>
<?php get_header(); ?>
<main id="content" class="portfolio">
    <div class="cover" style="background-image: url(<?php echo $post->field_cover; ?>);">
        <a href="<?php the_permalink(); ?>"><img src="<?php echo $post->field_profile; ?>" class="logo" /></a>
    </div>
    <div class="container has-content" id="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part('parts/portfolio', 'header'); ?>
            <?php the_content(); ?>
            <?php get_template_part('parts/portfolio', 'footer'); ?>
        </article>
        <?php if (comments_open() && !post_password_required()) {
            get_template_part('parts/comments');
        }
        endwhile; endif; ?>
    </div>
</main>
<script id="dsq-count-scr" src="//matias-sanchez-moises.disqus.com/count.js" async></script>
<?php get_footer(); ?>