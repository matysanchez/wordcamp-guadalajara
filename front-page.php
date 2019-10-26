<?php get_header(); ?>
<main id="home" class="container">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Home About")) : endif; ?>
    <!-- RECENT ARTICLES -->
    <h2 class="title">My Recent Articles</h2>
    <div class="row recent-articles">
        <?php
        $args = array(
            'numberposts' => 4,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish',
        );
        $recent_posts = wp_get_recent_posts($args);
        foreach ($recent_posts as $recent) {
            ?>
            <div class="col half recent">
                <?php if(has_post_thumbnail($recent["ID"])) {
                $chars = 140; ?>
                <img class="img" src="<?php echo get_the_post_thumbnail_url($recent["ID"], array(120, 120)); ?>">
                <?php } else $chars=220; ?>
                <h3>
                    <a href="<?php echo get_permalink($recent["ID"]); ?>" title="<?php echo $recent["post_title"]; ?>"><?php echo $recent["post_title"]; ?></a>
                </h3>
                <small>
                    <time datetime="<?php echo get_the_date('c', $recent["ID"]); ?>" itemprop="datePublished"><?php echo get_the_date(null, $recent["ID"]); ?></time>
                    | <a href="<?php echo get_permalink($recent["ID"]); ?>#disqus_thread">Comments</a>
                </small>
                <p><?php echo substr(get_the_excerpt($recent["ID"]), 0, $chars); ?>... <a href="<?php echo get_permalink($recent["ID"]); ?>">Read More</a>.</p>
                <div class="clearfix"></div>
            </div>
        <?php }
        wp_reset_query();
        ?>
        <div class="clearfix"></div>
        <p><a class="cta" href="/blog/">GO TO THE BLOG</a></p>
    </div>
    <!-- /RECENT ARTICLES -->
    <!-- WHAT I LOVE DOING -->
    <h2 class="title">What I love Doing</h2>
    <div class="row love-doing">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Skills")) : endif; ?>
    </div>
    <!-- /WHAT I LOVE DOING -->
    <!-- EXPERIENCE -->
    <h2 class="title">Portfolio</h2>
    <div class="row recent-articles">
        <?php
        $args = array(
            'numberposts' => 4,
            'orderby' => 'post_id',
            'order' => 'ASC',
            'post_type' => 'portfolios',
            'post_status' => 'publish',
        );
        $recent_posts = wp_get_recent_posts($args);
        foreach ($recent_posts as $recent) {
            ?>
            <div class="col half recent">
            <a href="<?php echo get_permalink($recent["ID"]); ?>" title="<?php echo $recent["post_title"]; ?>"><img class="img" src="<?php echo get_site_url() . get_post_meta($recent["ID"], 'square_logo', true); ?>" height="120" width="120"></a>
                <h3>
                    <a href="<?php echo get_permalink($recent["ID"]); ?>" title="<?php echo $recent["post_title"]; ?>"><?php echo $recent["post_title"]; ?></a>
                </h3>
                <small>
                    <time datetime="<?php echo get_the_date('c', $recent["ID"]); ?>" itemprop="datePublished"><?php echo returnFromTo($recent["ID"]); ?></time>
                </small>
                <p><?php echo substr(get_the_excerpt($recent["ID"]), 0, 140); ?>... <a href="<?php echo get_permalink($recent["ID"]); ?>">Read More</a>.</p>
                <div class="clearfix"></div>
            </div>
        <?php }
        wp_reset_query();
        ?>
        <div class="clearfix"></div>
        <p><a class="cta" href="/portfolio/">SEE MORE ABOUT MY EXPERIENCE</a></p>
    </div>
    <!-- /EXPERIENCE -->
</main>
<script id="dsq-count-scr" src="//matias-sanchez-moises.disqus.com/count.js" async></script>
<?php get_footer(); ?>
