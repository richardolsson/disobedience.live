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

        update_field('organizer', sanitize_text_field($_POST['organizer']), $event_id);
        update_field('start_date', sanitize_text_field($_POST['start_date']), $event_id);
        update_field('start_time', sanitize_text_field($_POST['start_time']), $event_id);
        update_field('end_date', sanitize_text_field($_POST['end_date']), $event_id);
        update_field('end_time', sanitize_text_field($_POST['end_time']), $event_id);
        update_field('city', sanitize_text_field($_POST['city']), $event_id);
        update_field('country', sanitize_text_field($_POST['country']), $event_id);
        update_field('contact_name', sanitize_text_field($_POST['contact']), $event_id);
        update_field('contact_email', sanitize_text_field($_POST['email']), $event_id);
        update_field('contact_phone', sanitize_text_field($_POST['phone']), $event_id);
        update_field('link', sanitize_text_field($_POST['link']), $event_id);
        update_field('open', $_POST['open'] == 'yes', $event_id);

        $done_page = get_field('event_submitted_page', 'option');
        $done_page_url = get_permalink($done_page->ID);
        header('Location: '.$done_page_url);
    }
    else {
        $error = 'Form must be re-submitted.';
    }

    $terms_page = get_field('event_terms_page', 'option');
    $terms_page_url = get_permalink($terms_page->ID);
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
                <li class="text-item event-form-organizer">
                    <label for="event-form-organizer">Event Organizer (e.g. organization)</label>
                    <input id="event-form-organizer" type="text" name="organizer">
                </li>
                <li class="text-item event-form-date">
                    <label for="event-form-start-date">Start date</label>
                    <input id="event-form-start-date" type="date" name="start_date">
                </li>
                <li class="text-item event-form-time">
                    <label for="event-form-start-time">Start time</label>
                    <input id="event-form-start-time" type="time" name="start_time">
                </li>
                <li class="text-item event-form-date">
                    <label for="event-form-end-date">End date</label>
                    <input id="event-form-end-date" type="date" name="end_date">
                </li>
                <li class="text-item event-form-time">
                    <label for="event-form-end-time">End time</label>
                    <input id="event-form-end-time" type="time" name="end_time">
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
                    <input id="event-form-link" type="text" name="link">
                </li>
                <li class="file-item event-form-image">
                    <span>Upload event photo here</span>
                    <div class="upload-warning">
                        Uploading the image may take some time. After submitting the form,
                        don't leave the page until it's done.
                    </div>
                    <input id="event-form-image" type="file" name="image">
                </li>
                <li class="event-form-open">
                    The screening is:
                    <ul class="radio-options">
                        <li class="radio-option">
                            <input id="event-form-open-yes" type="radio" name="open" value="yes" checked="checked">
                            <label for="event-form-open-yes">Public/open to anyone</label>
                        </li>
                        <li class="radio-option">
                            <input id="event-form-open-no" type="radio" name="open" value="no">
                            <label for="event-form-open-no">For invited groups or guests only</label>
                            <p class="small-print">
                                Your event will still be visible on the website, but it will be described as "not public"
                                and you can choose to not specify the street address (for example: screenings at home or
                                screenings in classrooms).
                            </p>
                        </li>
                    </ul>
                </li>
            </ul>
            <p>
                By submitting this form you assert that you have read and understood the basic values.
                <?php if ($terms_page): ?>
                <a href="<?php echo $terms_page_url;?>">Read the basic values</a>
                <?php endif; ?>
            </p>
            <input class="submit-button" type="submit" value="Add event to calendar">
        </form>
    </div>
</div>
<?php get_footer();?>
