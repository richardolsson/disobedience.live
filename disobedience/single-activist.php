<?php the_post();?>
<?php get_header();?>
<?php
    $facts = get_field('facts');
?>
<div class="content">
    <?php the_post_thumbnail();?>
    <div class="meta">
        <h1><?php the_title();?></h1>
        <?php if (!empty($facts)):?>
        <div class="facts">
            <ul class="fact-list">
            <?php foreach ($facts as $fact):?>
                <li class="fact-item">
                    <span class="label"><?php echo $fact['label'];?></span>
                    <span class="text"><?php echo $fact['text'];?></span>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
        <?php endif;?>
        <div class="sharing">
            <p class="share">
                <?php disobedience_pstr('activist_single_share');?>
                <input class="share" type="text" value="<?php the_permalink();?>">
            </p>
        </div>
    </div>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
</div>
<?php get_footer();?>
