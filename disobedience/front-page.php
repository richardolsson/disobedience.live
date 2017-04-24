<?php get_header();?>
<?php the_post();?>
<div class="content">
    <div class="teaser">
        <div class="teaser-text">
            <?php the_content() ;?>
        </div>
    </div>
</div>
<?php get_footer();?>
