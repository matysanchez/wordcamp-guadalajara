<?php get_header(); ?>
<main id="content" class="page">
    <div class="container has-content" id="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php if (comments_open() && !post_password_required()) {
                            comments_template('', true);
                        } ?>
        <?php endwhile;
        endif; ?>
    </div>
</main>
<?php get_footer(); ?>