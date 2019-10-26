<footer class="entry">
    <?php
    global $post;
    $prev_post = get_adjacent_post();
    if (isset($prev_post) && is_numeric($prev_post->ID)) {
        $prev_post_id = $prev_post->ID;
        ?>
        <div class="previous">
            <a href="<?php the_permalink($prev_post_id); ?>"><?php echo get_the_title($prev_post_id); ?> →</a><br>
        </div>
    <?php }

    $next_post = get_adjacent_post(false, '', false);
    if (isset($next_post) && is_numeric($next_post->ID)) {
        $next_post_id = $next_post->ID;
        ?>
        <div class="next">
            <a href="<?php the_permalink($next_post_id); ?>">← <?php echo get_the_title($next_post_id); ?></a><br>
        </div>
    <?php } ?>
    <div class="clearfix"></div>
</footer>