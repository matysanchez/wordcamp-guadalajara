<?php
global $post;
$post->field_cover = get_site_url() . get_post_meta(get_the_ID(), 'cover', true);
$post->field_profile = get_site_url() . get_post_meta(get_the_ID(), 'square_logo', true);
$post->field_position = get_post_meta(get_the_ID(), 'position', true);
$post->when = returnFromTo(get_the_ID());