<?php
global $post;

$categories = wp_get_post_categories( $post->ID );
$cats = array();
$i = 0;
foreach($categories as $c){
    $cat = get_category( $c );
    $cats[] = array( 'id' => $cat->cat_ID, 'name' => $cat->name, 'i' => $i );
    $i++;
}
?>
<header>
    <h1 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h1>
    <div class="entry-meta">
        <p>
            <?php if(!is_single()) {?><i class="webicon icon-comment">&#xe80c;</i> <a href="<?php echo get_permalink(get_the_ID()); ?>#disqus_thread">Comments</a><?php } ?>
            <i class="webicon icon-calendar">&#xe800;</i> <?php echo get_the_date(); ?>
            <i class="webicon icon-tags">&#xe804;</i> <?php foreach ($cats as $category) { ?>
            <a href="<?php echo get_category_link($category['id']); ?>" title="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a><?php if($category['i'] != ($i-1)) echo ', ';?>
            <?php } ?>
        </p>
    </div>
</header>