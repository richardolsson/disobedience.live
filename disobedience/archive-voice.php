<?php get_header(); ?>
<div class="content">
<?php
    if (have_posts()):
        while (have_posts()):
            the_post();
        ?>
        <div class="voices-item">
            <?php the_post_thumbnail();?>
            <h2><?php the_title();?></h2>
            <?php if (have_rows('facts')):?>
            <ul>
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
        endwhile;
    endif;
?>
</div>
<?php get_footer();
