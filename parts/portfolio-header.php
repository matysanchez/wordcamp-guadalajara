<?php
$h = "h1";
if ( !is_singular() ) {
    $h = "h2";
}
?>
<header>
    <<?php echo $h; ?> class="entry-title">
        <?php if($h === "h2") {?>
            <div class="portfoliologo">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo $post->field_profile; ?>" class="logo" /></a>
            </div>
        <?php } ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </<?php echo $h; ?>>
    <div class="entry-meta">
        <p>
            <i class="webicon icon-id-badge">&#xf2c1;</i> <?php echo $post->field_position; ?>
            <i class="webicon icon-calendar">&#xe800;</i> <?php echo $post->when; ?>
        </p>
    </div>
</header>