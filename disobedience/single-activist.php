<?php the_post();?>
<?php get_header();?>
<?php
    $facts = get_field('facts');
    $video_url = get_field('video_youtube_url');
    if (strpos($video_url, '//youtu.be') !== false) {
        $fields = explode('/', $video_url);
        $video_id = $fields[count($fields) - 1];
    }
    else {
        $qs = parse_url($video_url, PHP_URL_QUERY);
        parse_str($qs, $params);
        $video_id = $params['v'];
    }
?>
<div class="content">
    <?php the_post_thumbnail();?>
    <div class="text-content">
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
    <?php if (!empty($video_id)):?>
    <div class="video">
        <iframe
            width="560" height="315"
            src="https://www.youtube.com/embed/<?php echo $video_id; ?>"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>
    <?php endif;?>
</div>
<?php get_footer();?>
