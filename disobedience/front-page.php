<?php
    $start_time = mktime(0, 0, 0, 8, 24, 2017);
    $now = mktime();
    $diff = $start_time - $now;
    $days = $diff / 60 / 60 / 24;
?>
<?php get_header();?>
<?php the_post();?>
<div class="content">
    <div class="teaser">
        <div class="teaser-content">
            <?php if ($diff > 0):?>
            <div class="teaser-countdown" data-diff="<?php echo $diff; ?>">
                <div class="teaser-countdown-text"><?php printf('%d %s remaining', $days, $days==1? 'day':'days') ?></div>
            </div>
            <?php endif;?>
            <div class="teaser-text">
                <?php the_content() ;?>
            </div>
            <div class="teaser-cta">
                <a href="https://youtu.be/HrjkPm3kdTo"><?php echo __('Play trailer', 'disobedience');?></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
