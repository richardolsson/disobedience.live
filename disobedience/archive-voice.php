<?php
$voices = array();

while (have_posts()) {
    the_post();

    array_push($voices, $post);
}

shuffle($voices);
?>
<?php get_header(); ?>
<div class="content">
    <p class="intro">
        <?php disobedience_pstr('voices_archive_intro');?>
    </p>
    <div class="voices">
<?php
    if (!empty($voices)):
        foreach ($voices as $voice):
            global $post;

            $post = $voice;
            setup_postdata($voice);
        ?>
        <div class="voice">
            <a class="thumbnail" href="<?php echo get_field('youtube_url');?>">
                <?php the_post_thumbnail('voice-thumbnail');?>
            </a>
            <h2><?php the_title();?></h2>
            <?php if (have_rows('facts')):?>
            <ul class="fact-list">
            <?php while (have_rows('facts')): the_row();?>
                <li>
                    <span class="label"><?php the_sub_field('label');?>:<span>
                    <span class="value"><?php the_sub_field('text');?><span>
                </li>
            <?php endwhile;?>
            <?php endif;?>
            </ul>
        </div>
        <?php
        endforeach;
    endif;
?>
    </div>
</div>
<?php get_footer();
