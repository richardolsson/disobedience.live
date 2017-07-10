<?php
/*
 * Template Name: Event Added Page
 * Template Post Type: page
*/

get_header();
the_post();
?>
<div class="content post page event-added-page">
    <div class="post-content page-content">
        <h1><?php the_title();?></h1>
        <?php the_content();?>
    </div>
</div>
<?php get_footer();?>
