<?php
/*
 * Template Name: About Page
 * Template Post Type: page
*/

get_header();
the_post();

$start_time = mktime(10, 0, 0, 8, 22, 2017);
$now = mktime();
$diff = $start_time - $now;
$countdown_value = floor($diff / 60 / 60 / 24);
$countdown_unit = 'day';
if ($countdown_value < 1) {
    $countdown_value = round($diff / 60 / 60);
    $countdown_unit = 'hour';
}

if ($countdown_value > 0) {
    $countdown = sprintf('<div class="countdown"><div class="gradient"></div><h2>%d %s%s remaining</h2></div>',
            $countdown_value,
            $countdown_unit,
            $countdown_value==1? '':'s');
}
else if ($countdown_value < -120) {
    $countdown = '';
}
else {
    $start_time = mktime(22, 0, 0, 8, 21, 2017);
    $now = mktime();
    $diff = $start_time - $now;
    $countdown_value = abs($diff / 60);
    $minutes = (abs($diff) / 60) % 60;
    $hours = (abs($diff) / 60 / 60) % 24;
    $day = floor(abs($diff) / 60 / 60 / 24);
    $countdown = sprintf('<div class="countdown"><div class="gradient"></div><h2>DAY %d %02d:%02d</h2></div>',
            $day, $hours, $minutes);
}

// Hide countdown (updated after stream ends)
$countdown = '<div class="countdown"></div>';

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
