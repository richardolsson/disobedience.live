<?php
/*
 * Template Name: About Page
 * Template Post Type: page
*/

get_header();
the_post();

$start_time = mktime(12, 0, 0, 8, 22, 2017);
$now = mktime();
$diff = $start_time - $now;
$days = $diff / 60 / 60 / 24;
?>
<?

$countdown = sprintf('<div class="countdown"><div class="gradient"></div><h2>%d %s remaining</h2></div>', $days, $days==1? 'day':'days');

$html = apply_filters('the_content', get_the_content());
$html = preg_replace('/<\/p>\s*<p>/', '</p>'.$countdown.'<p>', $html, 1);
$tn_url = get_the_post_thumbnail_url();
?>
<div class="content post page about-page">
    <h1 style="background-image: url(<?php echo $tn_url;?>)"><?php the_title();?></h1>
    <div class="post-content page-content">
        <?php echo $html; ?>
    </div>
</div>
<?php get_footer();?>
