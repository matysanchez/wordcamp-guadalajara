<?php get_header(); ?>
<main id="content">
    <div class="container">
        <article id="post-0" class="post not-found">
            <header class="header">
                <h1 class="entry-title"><?php esc_html_e('Not Found', 'matysanchez'); ?></h1>
            </header>
            <div class="entry-content">
                <p><?php esc_html_e('Nothing found for the requested page. Try a search instead?', 'matysanchez'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </article>
    </div>
</main>
<?php get_footer(); ?>