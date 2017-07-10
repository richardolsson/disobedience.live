<?php
/*
 * Template Name: Add event page
 * Template Post Type: page
*/

if (isset($_POST)) {
    if (!function_exists('wp_handle_upload')) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

    if (isset($_POST['addevent_nonce']) && wp_verify_nonce($_POST['addevent_nonce'], 'addevent')) {
        $event_id = wp_insert_post(array(
            'post_type' => 'event',
            'post_title' => sanitize_title($_POST['title']),
            'post_content' => sanitize_text_field($_POST['info']),
        ));

        $file = wp_handle_upload($_FILES['image'], array('action' => 'addevent'));
        if (isset($file) && !isset($file['error'])) {
            $att_data = array(
                'post_title' => basename($file['file']),
                'post_content' => '',
                'post_status' => 'draft',
                'post_mime_type' => $file['type'],
            );

            $att_id = wp_insert_attachment($att_data, $file['file'], $event_id);
            $meta_id = set_post_thumbnail($event_id, $att_id);
        }

        update_field('date', sanitize_text_field($_POST['date']), $event_id);
        update_field('start_time', sanitize_text_field($_POST['start']), $event_id);
        update_field('end_time', sanitize_text_field($_POST['end']), $event_id);
        update_field('city', sanitize_text_field($_POST['city']), $event_id);
        update_field('country', sanitize_text_field($_POST['country']), $event_id);
        update_field('contact_name', sanitize_text_field($_POST['contact']), $event_id);
        update_field('contact_email', sanitize_text_field($_POST['email']), $event_id);
        update_field('contact_phone', sanitize_text_field($_POST['phone']), $event_id);
        update_field('link', sanitize_text_field($_POST['link']), $event_id);
        update_field('open', sanitize_text_field($_POST['open']), $event_id);
    }
    else {
        $error = 'Form must be re-submitted.';
    }
}

the_post();
get_header();
?>
<div class="content post page">
    <div class="post-image page-image">
        <?php the_post_thumbnail();?>
    </div>
    <h1><?php the_title();?></h1>
    <div class="post-content page-content">
        <?php the_content(); ?>
    </div>
    <div class="event-form">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="addevent">
            <?php wp_nonce_field('addevent', 'addevent_nonce'); ?>

            <ul class="form-items">
                <li class="text-item event-form-title">
                    <label for="event-form-title">Event Title</label>
                    <input id="event-form-title" type="text" name="title">
                </li>
                <li class="text-item event-form-date">
                    <label for="event-form-date">Date</label>
                    <input id="event-form-date" type="date" name="date">
                </li>
                <li class="text-item event-form-start">
                    <label for="event-form-start">Starts</label>
                    <input id="event-form-start" type="time" name="start">
                </li>
                <li class="text-item event-form-end">
                    <label for="event-form-end">Ends</label>
                    <input id="event-form-end" type="time" name="end">
                </li>
                <li class="text-item event-form-city">
                    <label for="event-form-city">City</label>
                    <input id="event-form-city" type="text" name="city">
                </li>
                <li class="text-item event-form-country">
                    <label for="event-form-country">Country</label>
                    <input id="event-form-country" type="text" name="country">
                </li>
                <li class="textarea-item event-form-info">
                    <label for="event-form-info">Event information</label>
                    <textarea id="event-form-info" name="info"></textarea>
                </li>
                <li class="text-item event-form-contact">
                    <label for="event-form-contact">Name of contact person</label>
                    <input id="event-form-contact" type="text" name="contact">
                </li>
                <li class="text-item event-form-email">
                    <label for="event-form-email">Contact email</label>
                    <input id="event-form-email" type="email" name="email">
                </li>
                <li class="text-item event-form-phone">
                    <label for="event-form-phone">Contact phone</label>
                    <input id="event-form-phone" type="text" name="phone">
                </li>
                <li class="text-item event-form-link">
                    <label for="event-form-link">Link (e.g. Facebook event)</label>
                    <input id="event-form-link" type="url" name="link">
                </li>
                <li class="file-item event-form-image">
                    <input id="event-form-image" type="file" name="image">
                </li>
                <li class="event-form-open">
                    <input id="event-form-open" type="checkbox" name="open" checked="checked">
                    <label for="event-form-open">Event is open (anyone may attend)</label>
                </li>
            </ul>
            <input class="submit-button" type="submit" value="Add event to calendar">
        </form>
    </div>
</div>
<?php get_footer();?>
