<?php the_post();?>
<?php get_header();?>
<div class="content post event">
    <div class="event-header<?php if (has_post_thumbnail()):?> with-image<?php endif;?>">
        <?php if (has_post_thumbnail()):?>
        <div class="image" style="background-image: url(<?php the_post_thumbnail_url();?>);">
        </div>
        <?php endif;?>
        <div class="info">
            <p class="title"><?php the_title();?></p>
            <p class="basic">
                <?php the_field('start_date');?>,
                <?php the_field('start_time');?>,
                <?php the_field('city')?>,
                <?php the_field('country')?>
            </p>
            <p class="organizer">
                <?php the_field('organizer');?>
            </p>
            <p class="share">
                Share this event:
                <input class="share" type="text" value="<?php the_permalink();?>">
            </p>
        </div>
    </div>
    <h1><?php the_title();?></h1>
    <div class="event-info">
        <?php the_content(); ?>
    </div>
</div>
<?php get_footer();?>
