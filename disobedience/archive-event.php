<?php get_header(); ?>
<div class="content">
<?php
    if (have_posts()):?>
    <table class="events-table">
        <thead>
            <tr>
                <th>City</th>
                <th>Date</th>
                <th>Start time</th>
                <th>Event title and organizers</th>
            </tr>
        </thead>
        <tbody>
    <?
        while (have_posts()):
            the_post();
        ?>
        <tr class="events-row">
            <td><?php the_field('city')?>, <?php the_field('country');?></td>
            <td><?php the_field('date'); ?></td>
            <td><?php the_field('start_time'); ?></td>
            <td>
                <span class="title"><?php the_title();?></span>
                <?php if (get_field('organizer')): ?>
                <span class="organizer"><?php the_field('organizer');?></span>
                <?php endif; ?>
            </td>
        </tr>
        <?php
        endwhile;
    endif;
?>
        </tbody>
    </table>
</div>
<?php get_footer();
